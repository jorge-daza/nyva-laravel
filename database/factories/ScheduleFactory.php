<?php

namespace Database\Factories;

use App\Models\Establishment;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Schedule> */
class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition(): array
    {
        return [
            'establishment_id' => Establishment::factory(),
            'day_of_week' => fake()->randomElement([
                'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday',
            ]),
            'opens_at' => '08:00:00',
            'closes_at' => '20:00:00',
            'status' => 'active',
        ];
    }
}
