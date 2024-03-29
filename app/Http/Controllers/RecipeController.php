<?php

namespace App\Http\Controllers;

use App\Services\RecipesService;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

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

      $rules = [
         'upload-proof-payment' => ['required'  , 'max:5120'],
     ];
 
     $customMessages = [
         'required' => 'Silahkan masukan bukti pembayaran.',
         'max' => 'bukti pembayaran tidak boleh lebih dari 5 mb'
     ];
 
     $this->validate($request, $rules, $customMessages);

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

      

      if($res){
         return redirect("admin/admin")->with('message' , "berhasil mennyetujui pembayaran obat");
      }else{
         return redirect("admin/admin")->withErrors("Gagal menyetujui pembayaran obat, terjadi kesalahan");
      }
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