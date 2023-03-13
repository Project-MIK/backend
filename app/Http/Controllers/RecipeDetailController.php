<?php

namespace App\Http\Controllers;

use App\Services\RecipeDetailsService;
use Illuminate\Http\Request;

class RecipeDetailController extends Controller
{
    //

    private RecipeDetailsService $service;

    public function __construct()
    {

        $this->service = new RecipeDetailsService();
    }

    public function store(array $request)
    {
        $res = $this->service->insert($request);
        return $res;
    }

    public function delete($idRecipe, $idMedicine)
    {
        return $this->service->delete($idRecipe, $idMedicine);
    }

    public function checkMedicine($idRecipe, $idMedicine)
    {
        return $this->service->checkMedicine($idRecipe , $idMedicine);
    }
}