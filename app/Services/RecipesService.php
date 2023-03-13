<?php

namespace App\Services;

use App\Models\Pattient;
use App\Models\Recipes;
use App\Models\Record;

class RecipesService
{

    private Recipes $model;
    private Record $record;


    public function __construct()
    {
        $this->model = new Recipes();
        $this->record = new Record();
    }


    public function insert($id)
    {
        $response = [];
        $res = $this->model->create([
            "price_medical_prescription" => 0,
            "pickup_medical_prescription" => "hospital-pharmacy",
            "pickup_medical_status" => "MENUNGGU DIAMBIL",
        ]);
        if ($res) {
            $response['status'] = true;
            $response['id'] = $res->id;
            $this->record->Where('id' , $id)->update([
                'id_recipe' => $res->id
            ]);
            return $response;
        } else {
            $response['status'] = false;
            $response['id'] = null;
            return $response;
        }

    }
    public function checkFindByIdInRecord($id)
    {
        $res = $this->record->where('id', $id)->first();
        if ($res->id_recipe != null) {
            return false;
        }
        return true;
    }

    public function update_total_price($total, $id)
    {
        $isUpdate = $this->model->where('id', $id)->update([
            'price_medical_prescription' => $total,
        ]);
        if ($isUpdate) {
            return true;
        }
        return false;
    }


    public function getLastInsertId(){
       $res = $this->model->orderBy('created_at' , 'desc')->first();   
       return $res->id;
    }

    public function findById($idRecipe){
        return $this->model->where('id' , $idRecipe)->first();
    }

}

?>