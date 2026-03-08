<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@nbtech.pt')],
            [
                'name' => env('ADMIN_NAME', 'Admin NBTech'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'NBTech123!')),
            ],
        );

        $admin->syncRoles(['admin']);
    }
}
