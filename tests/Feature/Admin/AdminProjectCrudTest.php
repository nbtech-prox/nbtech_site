<?php

namespace Tests\Feature\Admin;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminProjectCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_project_slug_is_normalized_from_input(): void
    {
        Role::findOrCreate('admin');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $response = $this->actingAs($admin)->post(route('admin.projects.store'), [
            'title' => 'Projeto Teste',
            'slug' => 'Projeto Teste Premium',
            'description' => 'Descrição de teste do projeto.',
            'technologies' => 'Laravel, TailwindCSS, AlpineJS',
            'project_url' => 'https://example.com',
            'category' => 'Web App',
            'featured' => '1',
            'published' => '1',
        ]);

        $project = Project::query()->where('title', 'Projeto Teste')->first();

        $this->assertNotNull($project);
        $response->assertRedirect(route('admin.projects.edit', $project));
        $this->assertSame('projeto-teste-premium', $project->slug);
    }

    public function test_admin_can_create_update_and_delete_project(): void
    {
        Role::findOrCreate('admin');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $storePayload = [
            'title' => 'Projeto Teste',
            'slug' => 'projeto-teste',
            'description' => 'Descrição de teste do projeto.',
            'technologies' => 'Laravel, TailwindCSS, AlpineJS',
            'project_url' => 'https://example.com',
            'category' => 'Web App',
            'featured' => '1',
            'published' => '1',
            'meta_title' => 'Projeto Teste',
            'meta_description' => 'Meta descrição de teste.',
        ];

        $createResponse = $this->actingAs($admin)->post(route('admin.projects.store'), $storePayload);

        $project = Project::query()->where('slug', 'projeto-teste')->first();

        $this->assertNotNull($project);
        $createResponse->assertRedirect(route('admin.projects.edit', $project));

        $updateResponse = $this->actingAs($admin)->put(route('admin.projects.update', $project), [
            ...$storePayload,
            'title' => 'Projeto Teste Atualizado',
            'slug' => 'projeto-teste-atualizado',
        ]);

        $updateResponse->assertSessionHas('status');

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'Projeto Teste Atualizado',
            'slug' => 'projeto-teste-atualizado',
        ]);

        $project = $project->fresh();

        $deleteResponse = $this->actingAs($admin)->delete(route('admin.projects.destroy', $project));

        $deleteResponse->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
