<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalRecordsStoreRequest;
use App\Mail\MailHelper;
use App\Models\MedicalRecords;
use App\Models\Pattient;
use App\Services\MedicalRecordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MedicalRecordsController extends Controller
{

    private MedicalRecordService $service;


    public function __construct()
    {
        $this->service = new MedicalRecordService();
    }
    public function index()
    {
        $data =  $this->service->findAll();
        return $data;
    }

    public function store(MedicalRecordsStoreRequest $request)
    {
        $validated = $request->validate($request->rules());
        $res = $this->service->insert($validated);
        if ($res['status']) {
            $id = $res['payload']['id_pattient'];
            $resSend = $this->service->sendEmailMedicalRecord($id, "no rekam medic");
            if ($resSend) {
                return redirect()->back()->with('message', 'berhasil menambahkan rekam medis pasien');
            } else {
                return redirect()->back()->with('message', 'berhasil menambahkan rekam medis pasien , tetapi gagal mengirim email');
            }
        } else {
            return redirect()->back()->with('message', 'gagal menambahkan rekam medis pasien');
        }
    }
    public function destroy($id)
    {
        $res = $this->service->deleteById($id);
        if ($res) {
            return redirect()->back()->with('message', 'berhasil menghapus rekam medis');
        } else {
            return redirect()->back()->with('message', 'berhasil menghapus rekam medis');
        }
    }

    public function show($id)
    {
        $res = $this->service->findByMedicalRecord($id);
        return $res;
    }
}
