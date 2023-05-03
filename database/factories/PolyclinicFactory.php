<?php

namespace Database\Factories;

use App\Models\Polyclinic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Polyclinic>
 */
class PolyclinicFactory extends Factory
{
    protected $model = Polyclinic::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name('make'),
            'record_category_id' => fake()->numberBetween(1, 3)
        ];
    }
}
