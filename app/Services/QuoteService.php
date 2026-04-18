<?php

namespace App\Services;

use App\Models\Quote;
use App\Support\QuoteDocumentTypes;
use App\Support\QuoteStatuses;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class QuoteService
{
    /**
     * @param  array<string, mixed>  $validated
     */
    public function create(array $validated): Quote
    {
        $payload = $this->sanitizePayload($validated);

        return DB::transaction(function () use ($payload): Quote {
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

            return $quote->load('items');
        });
    }

    /**
     * @param  array<string, mixed>  $validated
     */
    public function update(Quote $quote, array $validated): Quote
    {
        $payload = $this->sanitizePayload($validated);

        return DB::transaction(function () use ($quote, $payload): Quote {
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

            return $quote->load('items');
        });
    }

    public function markInvoiced(Quote $quote): Quote
    {
        return DB::transaction(function () use ($quote): Quote {
            $quote->update(['status' => QuoteStatuses::EMITTED]);

            if ($quote->document_type === QuoteDocumentTypes::PROFORMA && ! $quote->proforma_number) {
                $quote->update([
                    'proforma_number' => $this->generateDocumentNumber('proforma_number', 'PRF'),
                ]);
            }

            if ($quote->document_type === QuoteDocumentTypes::INVOICE_RECEIPT && ! $quote->invoice_receipt_number) {
                $quote->update([
                    'invoice_receipt_number' => $this->generateDocumentNumber('invoice_receipt_number', 'FR'),
                ]);
            }

            return $quote->refresh();
        });
    }

    public function markPaid(Quote $quote): Quote
    {
        return DB::transaction(function () use ($quote): Quote {
            $quote->update(['status' => QuoteStatuses::PAID]);

            if (! $quote->invoice_receipt_number) {
                $quote->update([
                    'invoice_receipt_number' => $this->generateDocumentNumber('invoice_receipt_number', 'FR'),
                ]);
            }

            return $quote->refresh();
        });
    }

    public function resolveDocumentNumber(Quote $quote, string $type): string
    {
        return DB::transaction(function () use ($quote, $type): string {
            if ($type === 'orcamento') {
                return $quote->number;
            }

            if ($type === QuoteDocumentTypes::PROFORMA) {
                if (! $quote->proforma_number) {
                    $quote->update([
                        'proforma_number' => $this->generateDocumentNumber('proforma_number', 'PRF'),
                    ]);
                }

                return (string) $quote->fresh()->proforma_number;
            }

            if (! $quote->invoice_receipt_number) {
                $quote->update([
                    'invoice_receipt_number' => $this->generateDocumentNumber('invoice_receipt_number', 'FR'),
                ]);
            }

            return (string) $quote->fresh()->invoice_receipt_number;
        });
    }

    /**
     * @param  array<string, mixed>  $validated
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
            'due_date' => ($validated['document_type'] ?? null) === QuoteDocumentTypes::PROFORMA
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
            ->orderByDesc('id')
            ->lockForUpdate()
            ->value('number');

        $lastSequence = (int) str((string) $last)->afterLast('-')->toString();
        $nextSequence = str_pad((string) ($lastSequence + 1), 4, '0', STR_PAD_LEFT);

        return "{$prefix}-{$nextSequence}";
    }

    private function generateDocumentNumber(string $column, string $prefix): string
    {
        $datePart = Carbon::now()->format('Ym');
        $formattedPrefix = "{$prefix}-{$datePart}";

        $last = Quote::query()
            ->where($column, 'like', "{$formattedPrefix}-%")
            ->orderByDesc('id')
            ->lockForUpdate()
            ->value($column);

        $lastSequence = (int) str((string) $last)->afterLast('-')->toString();
        $nextSequence = str_pad((string) ($lastSequence + 1), 4, '0', STR_PAD_LEFT);

        return "{$formattedPrefix}-{$nextSequence}";
    }
}
