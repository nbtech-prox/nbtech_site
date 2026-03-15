<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_without_admin_role_cannot_access_admin_area(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();

        $this->actingAs($user)
            ->get(route('admin.projects.index'))
            ->assertForbidden();
    }

    public function test_authenticated_admin_user_can_access_admin_area(): void
    {
        Role::findOrCreate('admin');

        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk();

        $this->actingAs($admin)
            ->get(route('admin.projects.index'))
            ->assertOk();
    }
}
