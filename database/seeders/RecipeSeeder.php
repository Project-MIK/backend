<?php

namespace Database\Seeders;

use App\Models\Recipes;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Recipes::create([
            "description" => 'obat untuk wna',
            "price_medical_prescription" => 900000,
            "pickup_medical_prescription" => "hospital-pharmacy",
            "pickup_medical_status" => 'MENUNGGU DIAMBIL',
            "pickup_medical_addreass_pacient" => "BWI",
            "pickup_medical_description" => 'alamat penerima tidak valid',
            "pickup_datetime" => Carbon::now()
        ]);
    }
}