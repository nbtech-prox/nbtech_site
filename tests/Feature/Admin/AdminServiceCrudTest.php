<?php

namespace Tests\Feature\Admin;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminServiceCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_update_and_delete_service(): void
    {
        Role::findOrCreate('admin');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $storePayload = [
            'title' => 'Consultoria Técnica',
            'description' => 'Apoio técnico para roadmap, arquitetura e execução.',
            'icon' => 'layers',
            'order' => 3,
        ];

        $createResponse = $this->actingAs($admin)->post(route('admin.services.store'), $storePayload);

        $service = Service::query()->where('title', 'Consultoria Técnica')->first();

        $this->assertNotNull($service);
        $createResponse->assertRedirect(route('admin.services.edit', $service));

        $updateResponse = $this->actingAs($admin)->put(route('admin.services.update', $service), [
            ...$storePayload,
            'title' => 'Consultoria Técnica Avançada',
            'order' => 1,
        ]);

        $updateResponse->assertSessionHas('status');

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'title' => 'Consultoria Técnica Avançada',
            'order' => 1,
        ]);

        $deleteResponse = $this->actingAs($admin)->delete(route('admin.services.destroy', $service));

        $deleteResponse->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }
}
