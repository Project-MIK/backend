<?php

namespace App\Http\Controllers;

use App\Services\RecipesService;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

   private RecipesService $service;

   public function __construct()
   {
      $this->service = new RecipesService();
   }

   public function store($id)
   {
      return $this->service->insert($id);
   }

   public function checkRecipe($idRecord)
   {
      return $this->service->checkFindByIdInRecord($idRecord);
   }

   public function getLastInsertID()
   {
      return $this->service->getLastInsertId();
   }


   public function updateBuktiPembayaran(Request $request, $id)
   {
      $res = $this->service->updateBuktiMedicalPrescription($request, $id);
      if ($res) {
         return redirect()->back()->with('message', 'berhasil mengirimkan bukti pembayaran , harap tunggu check secara berkala untuk melihat status anda');
      } else {
         return redirect()->back()->withErrors('Gagal mengirimkan bukti pembayaran');
      }
   }

   public function displayDataRequiresApproval()
   {
      $data = $this->service->displayDataRequiresApproval();
      return view('admin.receiptProof', ['data' => $data]);
   }

   public function acceptOrRejectMedicinePayment(Request $request)
   {
      $res = $this->service->acceptOrReject($request->except(['_token', '_method']));
      dd($res);
   }

   public function showDataDelivery()
   {
      $data = $this->service->showDataDelivery();
      return view('admin.delivery', ['data' => $data]);
   }

   public function actionDelivery(Request $request)
   {
      $dataRequest = [
         'status' => $request->status , 
         'description' => $request->description,
         'id_recipe' => $request->id_receipt
      ];
      $res = $this->service->actionDelivery($dataRequest);
      if($res){
         return back()->with('message' , 'berhasil memperbarui status delivery');
      }else{
         return back()->withErrors('gagal memperbarui status delivery');
      }
   }
}