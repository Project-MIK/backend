<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintStoreRequest;
use App\Http\Requests\RecordStoreRequest;
use App\Services\RecordService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


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
        $validator = Validator::make($request->all(), [
            'description' => ['required', 'max:255', 'min:10'],
            [
                'description.required' => 'Deskripsi keluhan tidak boleh kosong',
                "description.max" => "Deskripsi Keluhan tidak boleh lebih dari 255 huruf",
                'description.min' => "Deskripsi Keluhan tidak boleh kurang dari 10"
            ]
        ]);
        if ($validator->fails()) {
            return redirect('/konsultasi')->withErrors($validator);
        }
        if (Auth::guard('pattient')->check()) {
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
            if ($res['status']) {
                $id = $res['id'];
                return redirect("/konsultasi/$id#payment");
            } else {
                return redirect('dasboard')->with('message', 'gagal membuat konsultasi terjadi kesalahan');
            }
        } else {
            return redirect("/masuk")->with("message", "silahkan login terlebih dahulu");
        }

    }

    public function upadate()
    {

    }

    public function destroy($id)
    {
        dd($id);
    }

    public function updateBukti(Request $request, $id)
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
        if ($res) {
            return redirect()->back()->with("message", "berhasil menyetujui pembayaran");
        } else {
            return redirect()->back()->with("message", "gagal   menyetujui pembayaran");
        }
    }

    public function cancelConsultation($id)
    {
        $res = $this->service->cancelConsultation($id);
        if ($res) {
            return redirect('/dashboard');
        } else {
            return redirect()->back()->withErrors(['message' => "gagal membatalkan konsultasi"]);
        }
    }
}