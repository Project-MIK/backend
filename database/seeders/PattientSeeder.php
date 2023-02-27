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
            "name" => "zamz", 
            "password" =>  bcrypt("rahasia"),
            "email" => "email@gmail.com",
            "gender" => "M" , 
            "phone_number" => "085607185972",
            "address" => "003/005/Blokagung/Karangdoro/Tegalsari/Banyuwangi",
            "citizen" => "WNI" , 
            "profession" => "GURU" , 
            "date_birth" => "2023-02-08 12:51:41",
            "place_birth" => "bwi" , 
            "blood_group" => "B", 
            "nik" => 287639876267861,
            'medical_record_id' => 123123
        ]);
    }
}
