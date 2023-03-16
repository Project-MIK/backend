<?php

namespace App\Http\Controllers;

use App\Services\RecipesService;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    
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


    public function updateBuktiPembayaran(Request $request , $id){
       $res =  $this->service->updateBuktiMedicalPrescription($request , $id);
       if($res){
        return redirect()->back()->with('message' , 'berhasil mengirimkan bukti pembayaran , harap tunggu check secara berkala untuk melihat status anda');
       }else{
        return redirect()->back()->withErrors('Gagal mengirimkan bukti pembayaran');
       }
    }
    
    public function displayDataRequiresApproval(){
       $data =  $this->service->displayDataRequiresApproval();
    }
}
