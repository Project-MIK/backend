<?php

namespace App\Services;

use App\Models\RecipeDetails;

class RecipeDetailsService
{

    private RecipeDetails $model;

    public function __construct(){
        $this->model = new RecipeDetails();
    }

}


?>