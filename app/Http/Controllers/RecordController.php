<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordStoreRequest;
use App\Services\RecordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{

    private RecordService $service;


    public function __construct()
    {
        $this->service = new RecordService();
    }


    public function index()
    {
        return view('test.register');
    }

    public function store(Request $request)
    {
        $rules = [
            'description' => ['required' , 'max:255' , 'min:10'],
        ];
        $customMessages = [
            'description.required' => 'Deskripsi tidak boleh kosong' , 
            "description.max" => "Deskripsi tidak boleh lebih dari 255 huruf",
            'description.min' => "Deskripsi tidak boleh kurang dari 10"
        ];
        $data  = $this->validate($request, $rules, $customMessages);
        if(Auth::guard('pattient')->check()){
            $idMedicalRecord = Auth::guard('pattient')->user()->medical_record_id;
            $data = [
                "medical_record_id" => $idMedicalRecord,
                "description" => $request->description,
                "complaint" => $request->description,
                "id_schedules" => 1,
                "id_doctor" => 1,
                "id_category" => $request->category
            ];
            $res = $this->service->insert($data);   
            if($res['status']){
                $id = $res['id'];
                return redirect("/konsultasi/$id#payment");
            }else{
                return redirect('dasboard')->with('message' , 'gagal membuat konsultasi terjadi kesalahan');
            }
        }else{
            return redirect("/masuk")->with("message" , "silahkan login terlebih dahulu");
        }
        
    }

public function upadate()
    {
        
    }

    public function destroy($id){
        dd($id);
    }

    public function updateBukti(Request $request , $id)
    {
        // $rules = [
        //     'upload-proof-payment' => ['required', 'max:5120', 'mimes:jpeg,png,jng'],
        // ];
        // $customMessages = [
        //     'required' => 'Foto bukti pembayaran tidak boleh kosong',
        //     "max" => "Ukuran Foto tidak boleh lebih dari 5MB",
        //     "mimes" => "File harus berupa jpeg , png , atau jpg"
        // ];
        // $this->validate($request, $rules, $customMessages);
        // menyimpan data file yang diupload ke variabel $file
        $response = $this->service->updateBukti($id, $request);
        dd($response);
        if ($response) {
            return redirect()->back()->with('message', "berhasil mengupload bukti pembayaran , harap menunggu hasil validasi");
        } else {
            return redirect()->back()->with('message', "Gagal mengupload bukti pembayaran");
        }
    }

    public function validBukti(Request $request)
    {
        $id = $request->id;
        $res = $this->service->validBuktiPembayaran($id);
        if($res){
            return redirect()->back()->with("message" , "berhasil menyetujui pembayaran");
        }else{
            return redirect()->back()->with("message" , "gagal   menyetujui pembayaran");
        }
    }
}