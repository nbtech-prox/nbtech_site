<?php

namespace Tests\Feature\Seeders;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminUserSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_user_seeder_preserves_existing_password_by_default(): void
    {
        Role::findOrCreate('admin');

        $user = User::query()->create([
            'name' => 'Admin NBTech',
            'email' => 'admin@nbtech.pt',
            'password' => Hash::make('old-password'),
        ]);

        $this->seed(AdminUserSeeder::class);

        $user->refresh();

        $this->assertTrue(Hash::check('old-password', $user->password));
        $this->assertTrue($user->hasRole('admin'));
    }
}
