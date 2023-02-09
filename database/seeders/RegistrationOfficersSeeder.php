<?php

namespace Database\Seeders;

use App\Models\RegistrationOfficers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistrationOfficersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RegistrationOfficers::create([
            "name" => "zam" , 
            "password" => bcrypt("rahasia"),
            "address" => "bwi" , 
            "gender" => "M" ,
            "email" => "mohammadtajutzamzami07@gmail.com"
        ]);
    }
}
