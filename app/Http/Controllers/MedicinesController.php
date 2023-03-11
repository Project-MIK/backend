<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicinesStoreRequest;
use App\Http\Requests\MedicinesUpdateRequest;
use App\Http\Requests\StoreMedicinesRequest;
use App\Http\Requests\UpdateMedicinesRequest;
use App\Models\Medicines;
use App\Services\MedicineService;
use Illuminate\Http\Request;

class MedicinesController extends Controller
{
    //

    private MedicineService $service;


    public function __construct()
    {
        $this->service = new MedicineService();
        
    }

    public function index()
    {
        $data =  $this->service->findAll();
        return view('obat.obat' , ['data' => $data]);
    }

    public function showMedicineOnDropdown(){
        $data =  $this->service->findAll();
        return $data;
    }

    public function show($id)
    {
        return $this->service->findById($id);
    }

    public function create()
    {
    }
    public function store(MedicinesStoreRequest $request)
    {
        $data = $request->validate([
            "name" => ['required'] , 
            "price" => ["required"],
            "stock" => ['required']
        ]);
        $res = $this->service->insert($data);
        if ($res) {
            $message = [
                "status" => true,
                "message" => "berhasil menambahkan obat"
            ];
             return redirect()->back()->with('message', $message);
        } {
            $message = [
                "status" => false,
                "message" => "gagal menambahkan obat , terjadi kesalahan server"
            ];
             return redirect()->back()->with('message', $message);
        }
    }

    public function edit()
    {
    }

    public function update(MedicinesUpdateRequest $request , $id){
        $data = $request->validate($request->rules());
        $res = $this->service->update($data , $id);
        if($res['status'] ==  true){
            return redirect()->back()->with('message' , $res['message']);
        }else{
            return redirect()->back()->withErrors(['message' => $res['message']]);
        }
    }

    public function destroy($id)
    {
        $res = $this->service->destroy($id);
        if($res){
            return redirect()->back()->with('message' , "berhasil menghapus obat");
        }else{
            return redirect()->back()->with('message' , "gagal menghapus obat");
        }
       
    }
}
