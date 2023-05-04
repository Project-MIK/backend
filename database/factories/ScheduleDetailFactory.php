<?php

namespace Database\Factories;

use App\Models\ScheduleDetail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScheduleDetail>
 */
class ScheduleDetailFactory extends Factory
{
    protected $model = ScheduleDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'consultation_date' => Carbon::now()->addDay(), 
            'time_start' => Carbon::now()->addHour(), 
            'time_end' => Carbon::now()->addHours(2), 
            'link' => 'www.youtube.com', 
            'status' => fake()->randomElement(['kosong', 'terisi']), 
            'schedule_id' => fake()->numberBetween(1, 3)
        ];
    }
}
