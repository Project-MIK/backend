<?php

namespace Database\Factories;

use App\Models\Medicines;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicines>
 */
class MedicinesFactory extends Factory
{


    protected $model = Medicines::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name() , 
            'stock' => 10 , 
            'price' => 20000
        ];
    }
}
