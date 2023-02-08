<?php

namespace Database\Seeders;

use App\Models\Pattient;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class PattientSeeder extends Seeder
{
    use WithFaker;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pattient::create([
            "name" => "pattient", 
            "password" =>  bcrypt("rahasia"),
            "email" => "zam@gmail.com",
            "gender" => "W" , 
            "phone_number" => "085607185972",
            "address" => "bwi",
            "citizen" => "WNI" , 
            "profession" => "GURU" , 
            "date_birth" => Carbon::now()->toDateTimeString(),
            "place_birth" => "indonesia" , 
            "blood_group" => "B" , 
        ]);
    }
}
