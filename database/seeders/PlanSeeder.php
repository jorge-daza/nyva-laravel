<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic',
                'description' => 'Plan académico básico para demostración.',
                'monthly_price' => 30000,
                'annual_price' => 300000,
                'status' => 'active',
            ],
            [
                'name' => 'Professional',
                'description' => 'Plan académico intermedio para demostración.',
                'monthly_price' => 60000,
                'annual_price' => 600000,
                'status' => 'active',
            ],
            [
                'name' => 'Business',
                'description' => 'Plan académico avanzado para demostración.',
                'monthly_price' => 100000,
                'annual_price' => 1000000,
                'status' => 'active',
            ],
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(['name' => $plan['name']], $plan);
        }
    }
}
