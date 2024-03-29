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
            "email" => "safiraput66@gmail.com",
            "gender" => "M" , 
            "phone_number" => "085607185972",
            "address" => "003/005/Blokagung/Karangdoro/Tegalsari/Banyuwangi",
            "citizen" => "WNI" , 
            "profession" => "GURU" , 
            "date_birth" => "2023-02-08 12:51:41",
            "place_birth" => "bwi" , 
            "blood_group" => "B", 
            "nik" => 2876398762678612,
            'medical_record_id' => 123123
        ]);
        Pattient::create([
            "name" => "zamz", 
            "password" =>  bcrypt("rahasia"),
            "email" => "hiphopjunior242@gmail.com",
            "gender" => "M" , 
            "phone_number" => "085607185972",
            "address" => "003/005/Blokagung/Karangdoro/Tegalsari/Banyuwangi",
            "citizen" => "WNA" , 
            "profession" => "GURU" , 
            "date_birth" => "2023-02-08 12:51:41",
            "place_birth" => "bwi" , 
            "blood_group" => "B", 
            "no_paspor" => 9872653416527356,
            'medical_record_id' => 321321
        ]);
    }
}
