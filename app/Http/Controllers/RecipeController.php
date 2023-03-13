<?php

namespace App\Http\Controllers;

use App\Services\RecipesService;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    //

    private RecipesService $service;

    public function __construct(){
        $this->service = new RecipesService();
    }

    public function store($id){
        return $this->service->insert($id);
    }

    public function checkRecipe($idRecord){
       return $this->service->checkFindByIdInRecord($idRecord);
    }

    public function getLastInsertID(){
       return  $this->service->getLastInsertId();
    }
}
