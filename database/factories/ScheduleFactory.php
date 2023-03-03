<?php

namespace Database\Factories;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'doctor_id' => fake()->numberBetween(1, 3)
        ];
    }
}
