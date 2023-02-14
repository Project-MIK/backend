<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalRecordsStoreRequest;
use App\Models\MedicalRecords;
use App\Services\MedicalRecordService;
use Illuminate\Http\Request;

class MedicalRecordsController extends Controller
{

    private MedicalRecordService $service;

    
    public function __construct(){
        $this->service = new MedicalRecordService();
    }
    public function index(){
        $data =  $this->service->findAll();
        return view("medical_recors.medical_record" , ["data" => $data]);
    }

    public function store(MedicalRecordsStoreRequest $request){
        $validated = $request->validate($request->rules());
        
        $res = $this->service->insert($validated);
        if($res){
            return redirect()->back()->with('message' , 'berhasil menambahkan rekam medis pasien');
        }else{
            return redirect()->back()->with('message' , 'berhasil menambahkan rekam medis pasien');
        }
    }
    public function destroy($id){
        $res = $this->service->deleteById($id);
        if($res){
            return redirect()->back()->with('message' , 'berhasil menghapus rekam medis');
        }else{
            return redirect()->back()->with('message' , 'berhasil menghapus rekam medis');
        }
    }

    public function show($id){
        $res = $this->service->findById($id);
        return $res;
    }



}
