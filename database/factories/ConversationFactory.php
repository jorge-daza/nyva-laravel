<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\Establishment;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Conversation> */
class ConversationFactory extends Factory
{
    protected $model = Conversation::class;

    public function definition(): array
    {
        $startedAt = fake()->dateTimeBetween('-7 days', 'now');

        return [
            'establishment_id' => Establishment::factory(),
            'customer_identifier' => fake()->uuid(),
            'started_at' => $startedAt,
            'ended_at' => fake()->optional()->dateTimeBetween($startedAt, 'now'),
            'status' => 'closed',
        ];
    }
}
