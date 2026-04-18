<?php

namespace Tests\Feature\Admin;

use App\Models\Quote;
use App\Models\User;
use App\Support\QuoteStatuses;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminQuoteIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_filter_quotes_by_status_and_search(): void
    {
        Role::findOrCreate('admin');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        Quote::query()->create([
            'number' => 'ORC-202603-0001',
            'title' => 'Website institucional',
            'status' => QuoteStatuses::DRAFT,
            'document_type' => 'proforma',
            'issue_date' => '2026-03-25',
            'due_date' => '2026-04-10',
            'client_name' => 'Acme Lda',
            'tax_rate' => 23,
            'subtotal' => 100,
            'tax_total' => 23,
            'total' => 123,
        ]);

        Quote::query()->create([
            'number' => 'ORC-202603-0002',
            'title' => 'Loja online',
            'status' => QuoteStatuses::EMITTED,
            'document_type' => 'proforma',
            'issue_date' => '2026-03-25',
            'due_date' => '2026-04-10',
            'client_name' => 'Acme Lda',
            'tax_rate' => 23,
            'subtotal' => 100,
            'tax_total' => 23,
            'total' => 123,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.quotes.index', [
            'q' => 'Acme',
            'status' => QuoteStatuses::DRAFT,
        ]));

        $response->assertOk();
        $response->assertSee('ORC-202603-0001');
        $response->assertDontSee('ORC-202603-0002');
    }
}
