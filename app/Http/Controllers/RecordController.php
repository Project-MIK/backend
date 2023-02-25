<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordStoreRequest;
use App\Services\RecordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{

    private RecordService $service;


    public function __construct()
    {
        $this->service = new RecordService();
    }
    

    public function index(){
        return view('test.register');
    }

    public function store(RecordStoreRequest $request)
    {
        $data = $request->validate($request->rules());
        $res = $this->service->insert($data);
        // $res['status'] = true or false
        return redirect()->back()->with("message", $res['message']);
    }

    public function upadate()
    {

    }

    public function updateBukti(Request $request){
        $rules = [
            'avatar' => ['required' , 'max:5120' , 'mimes:jpeg,png,jng'],
        ];
        $customMessages = [
            'required' => 'Foto bukti pembayaran tidak boleh kosong' ,
            "max" => "Ukuran Foto tidak boleh lebih dari 5MB",
            "mimes" => "File harus berupa jpeg , png , atau jpg"
        ];
        $this->validate($request, $rules, $customMessages);
		// menyimpan data file yang diupload ke variabel $file
		$response = $this->service->updateBukti('KL0923210' , $request);
        if($response){
            return redirect()->back()->with('message' , "berhasil mengupload bukti pembayaran , harap menunggu hasil validasi");
        }else{
            return redirect()->back()->with('message' , "Gagal mengupload bukti pembayaran");
        }
    }
}