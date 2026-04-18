<?php

namespace Tests\Unit;

use App\Models\Quote;
use App\Services\QuoteService;
use App\Support\QuoteStatuses;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_quote_creates_items_and_calculated_totals(): void
    {
        $service = app(QuoteService::class);

        $quote = $service->create([
            'title' => 'Website institucional',
            'status' => QuoteStatuses::DRAFT,
            'document_type' => 'proforma',
            'issue_date' => '2026-03-25',
            'due_date' => '2026-04-10',
            'client_name' => 'Empresa X',
            'client_email' => 'geral@empresa.pt',
            'client_phone' => '+351912345678',
            'client_nif' => '123456789',
            'client_address' => 'Rua Central 123',
            'tax_rate' => 23,
            'notes' => 'Notas internas',
            'items' => [
                ['description' => 'Landing page', 'quantity' => 2, 'unit_price' => 100],
                ['description' => 'Integração formulário', 'quantity' => 1, 'unit_price' => 50],
            ],
        ]);

        $this->assertSame(250.0, (float) $quote->subtotal);
        $this->assertSame(57.5, (float) $quote->tax_total);
        $this->assertSame(307.5, (float) $quote->total);
        $this->assertCount(2, $quote->items);
        $this->assertStringStartsWith('ORC-', $quote->number);
    }

    public function test_mark_invoiced_and_paid_generate_document_numbers(): void
    {
        $service = app(QuoteService::class);

        $quote = Quote::query()->create([
            'number' => 'ORC-202603-0001',
            'title' => 'App mobile',
            'status' => QuoteStatuses::DRAFT,
            'document_type' => 'proforma',
            'issue_date' => '2026-03-25',
            'due_date' => '2026-04-10',
            'client_name' => 'Empresa Y',
            'tax_rate' => 23,
            'subtotal' => 100,
            'tax_total' => 23,
            'total' => 123,
        ]);

        $service->markInvoiced($quote);
        $quote->refresh();

        $this->assertSame(QuoteStatuses::EMITTED, $quote->status);
        $this->assertNotNull($quote->proforma_number);

        $service->markPaid($quote);
        $quote->refresh();

        $this->assertSame(QuoteStatuses::PAID, $quote->status);
        $this->assertNotNull($quote->invoice_receipt_number);
    }

    public function test_create_quote_generates_sequential_numbers(): void
    {
        $service = app(QuoteService::class);

        $first = $service->create([
            'title' => 'Projeto A',
            'status' => QuoteStatuses::DRAFT,
            'document_type' => 'proforma',
            'issue_date' => '2026-03-25',
            'due_date' => '2026-04-10',
            'client_name' => 'Cliente A',
            'tax_rate' => 23,
            'items' => [
                ['description' => 'Linha A', 'quantity' => 1, 'unit_price' => 100],
            ],
        ]);

        $second = $service->create([
            'title' => 'Projeto B',
            'status' => QuoteStatuses::DRAFT,
            'document_type' => 'proforma',
            'issue_date' => '2026-03-25',
            'due_date' => '2026-04-10',
            'client_name' => 'Cliente B',
            'tax_rate' => 23,
            'items' => [
                ['description' => 'Linha B', 'quantity' => 1, 'unit_price' => 100],
            ],
        ]);

        $this->assertNotSame($first->number, $second->number);
        $this->assertStringEndsWith('0001', $first->number);
        $this->assertStringEndsWith('0002', $second->number);
    }

    public function test_resolving_document_number_does_not_change_quote_status(): void
    {
        $service = app(QuoteService::class);

        $quote = Quote::query()->create([
            'number' => 'ORC-202603-0001',
            'title' => 'App mobile',
            'status' => QuoteStatuses::DRAFT,
            'document_type' => 'proforma',
            'issue_date' => '2026-03-25',
            'due_date' => '2026-04-10',
            'client_name' => 'Empresa Y',
            'tax_rate' => 23,
            'subtotal' => 100,
            'tax_total' => 23,
            'total' => 123,
        ]);

        $number = $service->resolveDocumentNumber($quote, 'proforma');
        $quote->refresh();

        $this->assertStringStartsWith('PRF-', $number);
        $this->assertSame(QuoteStatuses::DRAFT, $quote->status);
        $this->assertNotNull($quote->proforma_number);
    }
}
