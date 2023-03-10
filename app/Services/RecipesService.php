<?php

namespace App\Services;

use App\Models\Recipes;

class RecipesService
{

    private Recipes $model;


    public function __construct(){
        $this->model = new Recipes();
    }

}

?>