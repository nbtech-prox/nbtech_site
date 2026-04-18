<?php

namespace App\Actions\Quote;

use App\Models\Quote;
use App\Services\QuoteService;
use App\Support\QuoteDocumentTypes;
use Illuminate\Http\Response;

class DownloadQuoteDocument
{
    public function __construct(private readonly QuoteService $quotes) {}

    public function handle(Quote $quote, string $type): Response
    {
        $quote->load('items');

        $types = ['orcamento' => 'Orçamento'] + QuoteDocumentTypes::labels();

        abort_unless(isset($types[$type]), 404);

        $documentNumber = $this->quotes->resolveDocumentNumber($quote, $type);

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
}
