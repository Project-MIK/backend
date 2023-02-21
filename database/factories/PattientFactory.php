<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pattient>
 */
class PattientFactory extends Factory
{

    use WithFaker;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name() , 
            "email" => $this->faker->email(),
            "gender" => "M" , 
            "phone_number" => 123123123,
            "address" => $this->faker->address(),
            "password" => bcrypt("rahasia"),
            "citizen" =>"WNI" , 
            "profession" => "programer" , 
            "date_birth" => "2022-12-12" , 
            "place_birth" => "bwi" , 
            "blood_group" => "A" , 
            "NIK" => random_int(100000 , 999999),
        ];
    }
}
