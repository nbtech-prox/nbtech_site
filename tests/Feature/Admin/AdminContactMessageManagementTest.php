<?php

namespace Tests\Feature\Admin;

use App\Models\ContactMessage;
use App\Models\User;
use App\Support\ContactMessageTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminContactMessageManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_filter_messages_by_type_and_search(): void
    {
        Role::findOrCreate('admin');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        ContactMessage::query()->create([
            'name' => 'Ana Silva',
            'email' => 'ana@example.com',
            'company' => 'Acme Lda',
            'type' => ContactMessageTypes::BUDGET,
            'message' => 'Pedido de orçamento com contexto comercial.',
        ]);

        ContactMessage::query()->create([
            'name' => 'Bruno Costa',
            'email' => 'bruno@example.com',
            'company' => 'Acme Lda',
            'type' => ContactMessageTypes::CONTACT,
            'message' => 'Contacto geral sobre parceria.',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.messages.index', [
            'q' => 'Acme',
            'type' => ContactMessageTypes::BUDGET,
        ]));

        $response->assertOk();
        $response->assertSee('Ana Silva');
        $response->assertDontSee('Bruno Costa');
    }

    public function test_admin_sees_human_readable_budget_request_details(): void
    {
        Role::findOrCreate('admin');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $message = ContactMessage::query()->create([
            'name' => 'Ana Silva',
            'email' => 'ana@example.com',
            'company' => 'Acme Lda',
            'type' => ContactMessageTypes::BUDGET,
            'phone' => '+351912345678',
            'project_type' => 'web-app',
            'budget_range' => '2500-5000',
            'timeline' => '30-60-dias',
            'message' => 'Pedido de orçamento com contexto comercial.',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.messages.show', $message));

        $response->assertOk();
        $response->assertSee('Aplicacao web');
        $response->assertSee('2.500-5.000 EUR');
        $response->assertSee('30-60 dias');
    }
}
