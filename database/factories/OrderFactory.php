<?php

namespace Database\Factories;

use App\Models\Establishment;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Order> */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'establishment_id' => Establishment::factory(),
            'customer_name' => fake()->name(),
            'customer_phone' => fake()->numerify('3#########'),
            'delivery_address' => fake()->address(),
            'total' => 0,
            'status' => 'pending',
            'ordered_at' => now(),
        ];
    }
}
