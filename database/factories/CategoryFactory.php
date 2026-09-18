<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Category> */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'establishment_id' => Establishment::factory(),
            'name' => fake()->words(2, true),
            'description' => fake()->optional()->sentence(),
            'status' => 'active',
        ];
    }
}
