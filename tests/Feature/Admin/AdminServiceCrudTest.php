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

    public function test_admin_service_slug_is_normalized_from_input(): void
    {
        Role::findOrCreate('admin');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->post(route('admin.services.store'), [
            'title' => 'Consultoria Técnica',
            'description' => 'Apoio técnico para roadmap, arquitetura e execução.',
            'slug' => 'Consultoria Técnica Premium',
            'icon' => 'layers',
            'order' => 2,
        ]);

        $service = Service::query()->where('title', 'Consultoria Técnica')->first();

        $this->assertNotNull($service);
        $response->assertRedirect(route('admin.services.edit', $service));
        $this->assertSame('consultoria-tecnica-premium', $service->slug);
    }

    public function test_admin_can_create_update_and_delete_service(): void
    {
        Role::findOrCreate('admin');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $storePayload = [
            'title' => 'Consultoria Técnica',
            'description' => 'Apoio técnico para roadmap, arquitetura e execução.',
            'slug' => 'consultoria-tecnica',
            'icon' => 'layers',
            'order' => 3,
            'meta_title' => 'Consultoria Técnica para Empresas | NBTech',
            'meta_description' => 'Serviço de consultoria técnica da NBTech para arquitetura, roadmap e apoio à execução.',
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
            'slug' => 'consultoria-tecnica',
            'order' => 1,
            'meta_title' => 'Consultoria Técnica para Empresas | NBTech',
        ]);

        $deleteResponse = $this->actingAs($admin)->delete(route('admin.services.destroy', $service));

        $deleteResponse->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }
}
