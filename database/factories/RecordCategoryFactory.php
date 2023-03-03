<?php

namespace Database\Factories;

use App\Models\RecordCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecordCategory>
 */
class RecordCategoryFactory extends Factory
{
    protected $model = RecordCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_name' => fake()->words(2, true)
        ];
    }
}
