<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuoteRequest;
use App\Http\Requests\Admin\UpdateQuoteRequest;
use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class QuoteController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('q')->toString();

        $quotes = Quote::query()
            ->when($search, function ($query) use ($search): void {
                $query->where('number', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%");
            })
            ->latest('issue_date')
            ->paginate(12)
            ->withQueryString();

        return view('admin.quotes.index', [
            'quotes' => $quotes,
            'search' => $search,
            'statuses' => $this->statuses(),
        ]);
    }

    public function create(): View
    {
        return view('admin.quotes.create', [
            'statuses' => $this->statuses(),
            'documentTypes' => $this->documentTypes(),
            'defaultItems' => [
                ['description' => '', 'quantity' => '1.00', 'unit_price' => '0.00'],
            ],
        ]);
    }

    public function store(StoreQuoteRequest $request): RedirectResponse
    {
        $payload = $this->sanitizePayload($request->validated());

        $quote = Quote::query()->create([
            'number' => $this->generateNumber(),
            'title' => $payload['title'],
            'status' => $payload['status'],
            'document_type' => $payload['document_type'],
            'issue_date' => $payload['issue_date'],
            'due_date' => $payload['due_date'],
            'client_name' => $payload['client_name'],
            'client_email' => $payload['client_email'],
            'client_phone' => $payload['client_phone'],
            'client_nif' => $payload['client_nif'],
            'client_address' => $payload['client_address'],
            'tax_rate' => $payload['tax_rate'],
            'subtotal' => $payload['subtotal'],
            'tax_total' => $payload['tax_total'],
            'total' => $payload['total'],
            'notes' => $payload['notes'],
        ]);

        foreach ($payload['items'] as $index => $item) {
            $quote->items()->create([
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'line_total' => $item['line_total'],
                'position' => $index,
            ]);
        }

        return redirect()->route('admin.quotes.edit', $quote)
            ->with('status', 'Orçamento criado com sucesso.');
    }

    public function show(Quote $quote): View
    {
        $quote->load('items');

        return view('admin.quotes.show', [
            'quote' => $quote,
            'statuses' => $this->statuses(),
            'documentTypes' => $this->documentTypes(),
            'canMarkInvoiced' => $quote->status === 'draft',
            'canMarkPaid' => $quote->status === 'emitted',
        ]);
    }

    public function edit(Quote $quote): View
    {
        $quote->load('items');

        return view('admin.quotes.edit', [
            'quote' => $quote,
            'statuses' => $this->statuses(),
            'documentTypes' => $this->documentTypes(),
            'defaultItems' => $quote->items->map(fn ($item) => [
                'description' => $item->description,
                'quantity' => number_format((float) $item->quantity, 2, '.', ''),
                'unit_price' => number_format((float) $item->unit_price, 2, '.', ''),
            ])->all(),
        ]);
    }

    public function update(UpdateQuoteRequest $request, Quote $quote): RedirectResponse
    {
        $payload = $this->sanitizePayload($request->validated());

        $quote->update([
            'title' => $payload['title'],
            'status' => $payload['status'],
            'document_type' => $payload['document_type'],
            'issue_date' => $payload['issue_date'],
            'due_date' => $payload['due_date'],
            'client_name' => $payload['client_name'],
            'client_email' => $payload['client_email'],
            'client_phone' => $payload['client_phone'],
            'client_nif' => $payload['client_nif'],
            'client_address' => $payload['client_address'],
            'tax_rate' => $payload['tax_rate'],
            'subtotal' => $payload['subtotal'],
            'tax_total' => $payload['tax_total'],
            'total' => $payload['total'],
            'notes' => $payload['notes'],
        ]);

        $quote->items()->delete();

        foreach ($payload['items'] as $index => $item) {
            $quote->items()->create([
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'line_total' => $item['line_total'],
                'position' => $index,
            ]);
        }

        return back()->with('status', 'Orçamento atualizado com sucesso.');
    }

    public function destroy(Quote $quote): RedirectResponse
    {
        $quote->delete();

        return redirect()->route('admin.quotes.index')
            ->with('status', 'Orçamento removido com sucesso.');
    }

    public function downloadDocument(Quote $quote, string $type)
    {
        $quote->load('items');

        $types = [
            'orcamento' => 'Orçamento',
            'proforma' => 'Fatura Proforma',
            'fatura-recibo' => 'Fatura/Recibo',
        ];

        abort_unless(isset($types[$type]), 404);

        $documentNumber = $this->resolveDocumentNumber($quote, $type);

        if ($quote->status === 'draft') {
            $quote->update(['status' => 'emitted']);
        }

        $pdf = app('dompdf.wrapper')->loadView('admin.quotes.pdf', [
            'quote' => $quote,
            'documentType' => $types[$type],
            'documentNumber' => $documentNumber,
            'generatedAt' => now(),
            'company' => config('invoicing.company'),
        ])->setPaper('a4');

        $filename = sprintf('%s-%s-%s.pdf', strtolower($documentNumber), $type, now()->format('YmdHis'));

        return $pdf->download($filename)
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
    }

    public function markInvoiced(Quote $quote): RedirectResponse
    {
        $quote->update(['status' => 'emitted']);

        if ($quote->document_type === 'proforma' && !$quote->proforma_number) {
            $quote->update([
                'proforma_number' => $this->generateDocumentNumber('proforma_number', 'PRF'),
            ]);
        }

        if ($quote->document_type === 'fatura-recibo' && !$quote->invoice_receipt_number) {
            $quote->update([
                'invoice_receipt_number' => $this->generateDocumentNumber('invoice_receipt_number', 'FR'),
            ]);
        }

        return back()->with('status', 'Orçamento marcado como emitido.');
    }

    public function markPaid(Quote $quote): RedirectResponse
    {
        $quote->update(['status' => 'paid']);

        if (!$quote->invoice_receipt_number) {
            $quote->update(['invoice_receipt_number' => $this->generateDocumentNumber('invoice_receipt_number', 'FR')]);
        }

        return back()->with('status', 'Orçamento marcado como pago.');
    }

    /**
     * @return array<string, string>
     */
    private function statuses(): array
    {
        return [
            'draft' => 'Rascunho',
            'emitted' => 'Emitido',
            'paid' => 'Pago',
            'cancelled' => 'Cancelado',
        ];
    }

    /**
     * @return array<string, string>
     */
    private function documentTypes(): array
    {
        return [
            'proforma' => 'Fatura Proforma',
            'fatura-recibo' => 'Fatura/Recibo',
        ];
    }

    /**
     * @param array<string, mixed> $validated
     * @return array<string, mixed>
     */
    private function sanitizePayload(array $validated): array
    {
        $taxRate = round((float) ($validated['tax_rate'] ?? 23), 2);

        $items = collect($validated['items'] ?? [])
            ->map(function (array $item): array {
                $quantity = round((float) $item['quantity'], 2);
                $unitPrice = round((float) $item['unit_price'], 2);

                return [
                    'description' => trim((string) $item['description']),
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => round($quantity * $unitPrice, 2),
                ];
            })
            ->filter(fn (array $item): bool => $item['description'] !== '')
            ->values();

        $subtotal = round((float) $items->sum('line_total'), 2);
        $taxTotal = round($subtotal * ($taxRate / 100), 2);
        $total = round($subtotal + $taxTotal, 2);

        return [
            'title' => trim((string) $validated['title']),
            'status' => $validated['status'],
            'document_type' => $validated['document_type'],
            'issue_date' => $validated['issue_date'],
            'due_date' => ($validated['document_type'] ?? null) === 'proforma'
                ? ($validated['due_date'] ?? null)
                : null,
            'client_name' => trim((string) $validated['client_name']),
            'client_email' => $validated['client_email'] ?? null,
            'client_phone' => $validated['client_phone'] ?? null,
            'client_nif' => $validated['client_nif'] ?? null,
            'client_address' => $validated['client_address'] ?? null,
            'tax_rate' => $taxRate,
            'notes' => $validated['notes'] ?? null,
            'items' => $items->all(),
            'subtotal' => $subtotal,
            'tax_total' => $taxTotal,
            'total' => $total,
        ];
    }

    private function generateNumber(): string
    {
        $datePart = Carbon::now()->format('Ym');
        $prefix = "ORC-{$datePart}";

        $last = Quote::query()
            ->where('number', 'like', "{$prefix}-%")
            ->latest('id')
            ->value('number');

        $lastSequence = (int) str($last)->afterLast('-')->toString();
        $nextSequence = str_pad((string) ($lastSequence + 1), 4, '0', STR_PAD_LEFT);

        return "{$prefix}-{$nextSequence}";
    }

    private function resolveDocumentNumber(Quote $quote, string $type): string
    {
        if ($type === 'orcamento') {
            return $quote->number;
        }

        if ($type === 'proforma') {
            if (!$quote->proforma_number) {
                $quote->update([
                    'proforma_number' => $this->generateDocumentNumber('proforma_number', 'PRF'),
                ]);
            }

            return (string) $quote->fresh()->proforma_number;
        }

        if (!$quote->invoice_receipt_number) {
            $quote->update([
                'invoice_receipt_number' => $this->generateDocumentNumber('invoice_receipt_number', 'FR'),
            ]);
        }

        return (string) $quote->fresh()->invoice_receipt_number;
    }

    private function generateDocumentNumber(string $column, string $prefix): string
    {
        $datePart = Carbon::now()->format('Ym');
        $formattedPrefix = "{$prefix}-{$datePart}";

        $last = Quote::query()
            ->where($column, 'like', "{$formattedPrefix}-%")
            ->latest('id')
            ->value($column);

        $lastSequence = (int) str((string) $last)->afterLast('-')->toString();
        $nextSequence = str_pad((string) ($lastSequence + 1), 4, '0', STR_PAD_LEFT);

        return "{$formattedPrefix}-{$nextSequence}";
    }
}
