<?php

namespace App\Http\Controllers;

use App\Services\RecipeDetailsService;
use App\Services\RecipesService;
use App\Services\RecordService;
use Illuminate\Http\Request;

class RecipeDetailController extends Controller
{
    //

    private RecipeDetailsService $service;
    private RecipesService $recipeService;
    private RecordService $recordService;

    public function __construct()
    {
        $this->recordService = new RecordService();
        $this->service = new RecipeDetailsService();
        $this->recipeService = new RecipesService();
    }

    public function store(array $request)
    {
        $res = $this->service->insert($request);
        if($res){
            $this->recordService->update_to_consultation_payment_waiting($request['id_consule']);
            $recipeData = $this->recipeService->findById($request['id_recipe']);
            $totalInRecipe = $recipeData->price_medical_prescription;
            $totaltemp = $request['total'];
            $finalTotal = $totalInRecipe + $totaltemp;
            $this->recipeService->update_total_price($finalTotal , $request['id_recipe']);
            return true;
        }else{
            return false;
        }
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