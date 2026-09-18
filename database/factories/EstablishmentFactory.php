<?php

namespace Database\Factories;

use App\Models\Establishment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Establishment> */
class EstablishmentFactory extends Factory
{
    protected $model = Establishment::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'type' => fake()->randomElement(['restaurant', 'hotel', 'dark_kitchen']),
            'description' => fake()->optional()->paragraph(),
            'address' => fake()->address(),
            'phone' => fake()->numerify('3#########'),
            'email' => fake()->companyEmail(),
            'status' => 'active',
            'registered_at' => now(),
        ];
    }
}
