<?php

namespace Database\Seeders;

use App\Models\RecipeDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        RecipeDetails::create(
            [
                "id_recipe" => 1 , 
                "id_medicine" => 1,
                "qty" => 2,
                "total_price" => 20000,
            ]
        );
    }
}
