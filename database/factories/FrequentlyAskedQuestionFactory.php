<?php

namespace Database\Factories;

use App\Models\Establishment;
use App\Models\FrequentlyAskedQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<FrequentlyAskedQuestion> */
class FrequentlyAskedQuestionFactory extends Factory
{
    protected $model = FrequentlyAskedQuestion::class;

    public function definition(): array
    {
        return [
            'establishment_id' => Establishment::factory(),
            'question' => fake()->sentence(),
            'answer' => fake()->paragraph(),
            'status' => 'active',
        ];
    }
}
