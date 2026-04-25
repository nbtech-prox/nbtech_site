<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        Role::findOrCreate('admin');

        $admin = User::query()->firstOrNew([
            'email' => env('ADMIN_EMAIL', 'admin@nbtech.pt'),
        ]);

        $admin->name = env('ADMIN_NAME', 'Admin NBTech');

        if (! $admin->exists || env('ADMIN_FORCE_RESET_PASSWORD', false)) {
            $password = env('ADMIN_PASSWORD');

            if (app()->environment('production') && ! $password) {
                throw new RuntimeException('ADMIN_PASSWORD must be set in production.');
            }

            $admin->password = Hash::make($password ?: 'NBTechAdmin!2026');
        }

        $admin->save();

        $admin->syncRoles(['admin']);
    }
}
