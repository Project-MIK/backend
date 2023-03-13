<?php

namespace App\Services;

use App\Models\Pattient;
use App\Models\RecipeDetails;

class RecipeDetailsService
{

    private RecipeDetails $model;
    private Pattient $patient;

    public function __construct()
    {
        $this->model = new RecipeDetails();
        $this->patient = new Pattient();
    }


    public function showDataRecipePatient($idRecord)
    {
        return $this->patient->join('medical_records', 'medical_records.medical_record_id', 'pattient.medical_record_id')
            ->join('record', 'record.medical_record_id', 'medical_records.medical_record_id')
            ->join('recipes', 'record.id_recipe', 'recipes.id')
            ->join('recipe_detail', 'recipes.id', 'recipe_detail.id_recipe')
            ->join('medicines', 'recipe_detail.id_medicine', 'medicines.id')
            ->select('medicines.id as id', 'medicines.name', 'recipe_detail.qty', 'medicines.price', 'recipe_detail.total_price as total')
            ->where('record.id', $idRecord)
            ->get()->toArray();
    }

    public function insert(array $request)
    {
        $res = $this->model->create([
            "id_recipe" => $request['id_recipe'],
            "id_medicine" => $request['id_medicine'],
            "qty" => $request['qty'],
            "total_price" => $request['total']
        ]);
        if ($res) {
            return true;
        }
        return false;
    }

    public function delete($idRecipe, $idMedicine)
    {
        return $this->model->where('id_recipe', $idRecipe)->where('id_medicine', $idMedicine)->delete();
    }


    public function checkMedicine($idRecipe, $idMedicine)
    {
        $data = $this->model->where('id_recipe', $idRecipe)->where('id_medicine', $idMedicine)->first();
        if($data != null){
            return false;
        }
        return true;
    }

}


?>