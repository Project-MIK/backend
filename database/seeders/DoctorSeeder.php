<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::create([
            "name" => "doktor kons", 
            "gender" => "M" , 
            "address" => "jember" , 
            "phone" => 123 , 
            "id_polyclinic" => 1
        ]);
    }
}
