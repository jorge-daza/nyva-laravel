<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevelopmentUserSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('SEED_DEMO_PASSWORD', 'NYVA-Demo-Only-ChangeMe-2026!');

        User::updateOrCreate(
            ['email' => 'platform.admin@nyva.test'],
            [
                'first_name' => 'Platform',
                'last_name' => 'Admin',
                'password' => Hash::make($password),
                'role' => 'platform_admin',
                'status' => 'active',
                'registered_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'establishment.admin@nyva.test'],
            [
                'first_name' => 'Establishment',
                'last_name' => 'Admin',
                'password' => Hash::make($password),
                'role' => 'establishment_admin',
                'status' => 'active',
                'registered_at' => now(),
            ]
        );
    }
}
