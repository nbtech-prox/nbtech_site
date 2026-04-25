<?php

namespace Tests\Feature\Admin;

use App\Models\Quote;
use App\Models\User;
use App\Support\QuoteStatuses;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminQuoteWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_downloading_missing_issued_document_does_not_mutate_quote(): void
    {
        Role::findOrCreate('admin');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $quote = Quote::query()->create([
            'number' => 'ORC-202603-0001',
            'title' => 'Website institucional',
            'status' => QuoteStatuses::DRAFT,
            'document_type' => 'proforma',
            'issue_date' => '2026-03-25',
            'due_date' => '2026-04-10',
            'client_name' => 'Empresa X',
            'tax_rate' => 23,
            'subtotal' => 100,
            'tax_total' => 23,
            'total' => 123,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.quotes.pdf', [
            'quote' => $quote,
            'type' => 'proforma',
        ]));

        $response->assertConflict();
        $quote->refresh();
        $this->assertSame(QuoteStatuses::DRAFT, $quote->status);
        $this->assertNull($quote->proforma_number);
    }
}
