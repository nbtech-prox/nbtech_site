<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Quote\DownloadQuoteDocument;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuoteRequest;
use App\Http\Requests\Admin\UpdateQuoteRequest;
use App\Models\Quote;
use App\Repositories\QuoteRepository;
use App\Services\QuoteService;
use App\Support\QuoteDocumentTypes;
use App\Support\QuoteStatuses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuoteController extends Controller
{
    public function index(Request $request, QuoteRepository $quotes): View
    {
        $this->authorize('viewAny', Quote::class);

        $search = $request->string('q')->toString();
        $statuses = QuoteStatuses::labels();
        $selectedStatus = $request->string('status')->toString();

        if (! array_key_exists($selectedStatus, $statuses)) {
            $selectedStatus = '';
        }

        return view('admin.quotes.index', [
            'quotes' => $quotes->paginateForAdmin(
                $search ?: null,
                $selectedStatus !== '' ? $selectedStatus : null,
            ),
            'search' => $search,
            'selectedStatus' => $selectedStatus,
            'statuses' => $statuses,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Quote::class);

        return view('admin.quotes.create', [
            'statuses' => QuoteStatuses::labels(),
            'documentTypes' => QuoteDocumentTypes::labels(),
            'defaultItems' => [
                ['description' => '', 'quantity' => '1.00', 'unit_price' => '0.00'],
            ],
        ]);
    }

    public function store(StoreQuoteRequest $request, QuoteService $service): RedirectResponse
    {
        $this->authorize('create', Quote::class);

        $quote = $service->create($request->validated());

        return redirect()->route('admin.quotes.edit', $quote)
            ->with('status', 'Orçamento criado com sucesso.');
    }

    public function show(Quote $quote): View
    {
        $this->authorize('view', $quote);

        $quote->load('items');

        return view('admin.quotes.show', [
            'quote' => $quote,
            'statuses' => QuoteStatuses::labels(),
            'documentTypes' => QuoteDocumentTypes::labels(),
            'canMarkInvoiced' => $quote->canMarkInvoiced(),
            'canMarkPaid' => $quote->canMarkPaid(),
        ]);
    }

    public function edit(Quote $quote): View
    {
        $this->authorize('update', $quote);

        $quote->load('items');

        return view('admin.quotes.edit', [
            'quote' => $quote,
            'statuses' => QuoteStatuses::labels(),
            'documentTypes' => QuoteDocumentTypes::labels(),
            'defaultItems' => $quote->items->map(fn ($item) => [
                'description' => $item->description,
                'quantity' => number_format((float) $item->quantity, 2, '.', ''),
                'unit_price' => number_format((float) $item->unit_price, 2, '.', ''),
            ])->all(),
        ]);
    }

    public function update(UpdateQuoteRequest $request, Quote $quote, QuoteService $service): RedirectResponse
    {
        $this->authorize('update', $quote);

        $service->update($quote, $request->validated());

        return back()->with('status', 'Orçamento atualizado com sucesso.');
    }

    public function destroy(Quote $quote): RedirectResponse
    {
        $this->authorize('delete', $quote);

        $quote->delete();

        return redirect()->route('admin.quotes.index')
            ->with('status', 'Orçamento removido com sucesso.');
    }

    public function downloadDocument(Quote $quote, string $type, DownloadQuoteDocument $downloadQuoteDocument)
    {
        $this->authorize('view', $quote);

        return $downloadQuoteDocument->handle($quote, $type);
    }

    public function markInvoiced(Quote $quote, QuoteService $service): RedirectResponse
    {
        $this->authorize('update', $quote);

        $service->markInvoiced($quote);

        return back()->with('status', 'Orçamento marcado como emitido.');
    }

    public function markPaid(Quote $quote, QuoteService $service): RedirectResponse
    {
        $this->authorize('update', $quote);

        $service->markPaid($quote);

        return back()->with('status', 'Orçamento marcado como pago.');
    }
}
