<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComplaintStoreRequest;
use App\Http\Requests\RecordStoreRequest;
use App\Services\MedicineService;
use App\Services\RecipeDetailsService;
use App\Services\RecordService;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class RecordController extends Controller
{

    private RecordService $service;
    private RecipeDetailsService $recipeDetailService;

    private MedicineService $medicineService;

    public function __construct()
    {
        $this->service = new RecordService();
        $this->recipeDetailService = new RecipeDetailsService();
        $this->medicineService = new MedicineService();
    }


    public function index()
    {
        return view('test.register');
    }

    public function store(Request $request)
    {
        // request need to create function findby(date , time_start, time_end)
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
        $rules = [
            'upload-proof-payment' => ['required', 'max:5120'],
        ];

        $customMessages = [
            'required' => 'Silahkan masukan bukti pembayaran.',
            'max' => 'bukti pembayaran tidak boleh lebih dari 5 mb'
        ];

        $this->validate($request, $rules, $customMessages);
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


    public function showComplaintOnAdmin()
    {
        $data = $this->service->showComplaintOnAdmin();
        return view('admin.complain', ['data' => $data]);
    }

    public function confirmStatusPayment(Request $request)
    {
        $res = $this->service->acceptPaymentOrDecline($request->id, $request->status);
        return redirect()->back()->with('message', $res['message']);
    }

    public function showConsulByDoctor()
    {
        // $id = Auth::guard('admin')->user()->id; // change with id doctor
        $id = 1;
        $data = $this->service->showConsulByDocter($id);
        return view('doctor.pages.consul', ['data' => $data]);
    }

    public function startCoverenceByAdmin($id)
    {
        $receipt = $this->recipeDetailService->showDataRecipePatient($id);
        $medicine = $this->medicineService->findAll();
        $data = $this->service->startConverenceAdminById($id);
        // $milliseconds = $data['time_start']; // example millisecond timestamp
        // $start = Carbon::createFromTimestamp($milliseconds);
        // $formattedDate = $start->format('Y-m-d H:i');

        if ($data != null) {
            // if (time() > $data['time_end']) {
            //     return back()->withErrors("waktu consultasi sudah selesai");
            // }
            // if (time() < [$data['time_start']]) {
            //     return back()->withErrors("Konsultasi akan dimulai pada : " . $formattedDate);
            // }
            return view('admin.jitsi', ['data' => $data, 'medicine' => $medicine, 'receipt' => $receipt, 'id_complaint' => $id]);
        } else {
            return back()->withErrors("data consul tidak ditemukan");
        }
    }

    public function showConsulOnAdmin()
    {
        $data = $this->service->showConsulAdmin();
        return view('admin.consul', ['data' => $data]);

    }


    public function addRecipe(Request $request)
    {
        dd($request);
    }

    public function setMetodeDelivery(Request $request, $id)
    {
        $dataRequest = $request->except(['_token']);
        $dataRequest['id'] = $id;
        $this->service->setMetodeDelivery($dataRequest);
        return redirect('/konsultasi/' . $id);
    }

    public function cetakDocument($id){
        return $this->service->cetakDokumentPengambilanObat($id);
    }

    public function getJitsiDocter($id){
        $data = $this->service->getJitsiViewDoctor($id);
        dd($data);
        return view('doctor.pages.jitsi', ['data' => $data]);
    }

}