<?php

namespace Database\Seeders;

use App\Models\Medicines;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medicines::create([
            "name" => "influeza" , 
            "price" => 20000,
            "stock" => 20 ,             
        ]);
        Medicines::create([
            "name" => "pilek" , 
            "price" => 20000,
            "stock" => 20 ,             
        ]);
    }
}
