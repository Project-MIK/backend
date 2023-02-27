<?php

namespace App\Http\Controllers;

use App\Http\Requests\PattienLoginRequest;
use App\Http\Requests\StorePattientMedicalRequest;
use App\Http\Requests\StorePattientRequest;
use App\Http\Requests\UpdatePattientRequest;
use App\Mail\MailHelper;
use App\Models\Pattient;
use App\Services\MedicalRecordService;
use App\Services\PattientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\isEmpty;

class PattientController extends Controller
{

    private PattientService $service;
    private MedicalRecordService $medicalRecordService;


    public function __construct()
    {
        $this->service = new PattientService();
        $this->medicalRecordService = new MedicalRecordService();
    }
    public function index()
    {
        $data = $this->service->findAll();
        return view('admin.pasien', ["data" => $data]);
        // no data
    }
    public function create()
    {
        // return view create new pattient
    }
    public function store(StorePattientRequest $request)
    {
        if ($request['citizen'] == 'WNI') {
            $res = $this->service->store($request->validate([
                'fullname' => ['required', 'string', 'min:4'],
                'email' => ['required', 'email', 'unique:pattient,email'],
                'gender' => ['required'],
                'password' => ['required'],
                'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:13'],
                'address_RT' => ['required', 'numeric', 'digits:2'],
                'address_RW' => ['required', 'numeric', 'digits:2'],
                'address_desa' => ['required', 'string'],
                'address_dusun' => ['required', 'string'],
                'address_kecamatan' => ['required', 'string'],
                'address_kabupaten' => ['required', 'string'],
                'citizen' => ['required'],
                'profession' => ['required'],
                'date_birth' => ['required'],
                'blood_group' => ['required'],
                'place_birth' => ['required'],
                'nik' => ['required', 'digits:16', 'unique:pattient,nik']
            ]));
            if ($res) {
                return redirect()->back()->with('message', 'berhasil registrasi harap menunggu hingga no rekam medis di kirimkan');
            } else {
                return redirect()->back()->with('message', 'gagal registrasi terjadi kesalahan server');
            }
        } else {

            $res = $this->service->store($request->validate([
                'fullname' => ['required', 'string', 'min:4'],
                'email' => ['required', 'email', 'unique:pattient,email'],
                'gender' => ['required'],
                'password' => ['required'],
                'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:13'],
                'address_RT' => ['required', 'numeric', 'digits:2'],
                'address_RW' => ['required', 'numeric', 'digits:2'],
                'address_desa' => ['required', 'string'],
                'address_dusun' => ['required', 'string'],
                'address_kecamatan' => ['required', 'string'],
                'address_kabupaten' => ['required', 'string'],
                'citizen' => ['required'],
                'profession' => ['required'],
                'date_birth' => ['required'],
                'blood_group' => ['required'],
                'place_birth' => ['required'],
                'no_paspor' => ['required', 'digits:16', 'unique:pattient,nik']
            ]));
        }
        if ($res) {
            return redirect()->back()->with('message', 'berhasil registrasi harap menunggu hingga no rekam medis di kirimkan');
        } else {
            return redirect()->back()->with('message', 'gagal registrasi terjadi kesalahan server');
        }

    }
    public function storewithRekamMedic(StorePattientMedicalRequest $request)
    {
        $rules = [
            'medical_record_id' => ['required', 'digits:6'],
            'id_registration_officer' => 'required',
        ];

        $customMessages = [
            'required' => 'rekam medic tidak boleh kosong',
            "digits:6" => "rekam medic hanya boleh sepanjang 6 digit"
        ];
        $this->validate($request, $rules, $customMessages);
        $res = $this->medicalRecordService->findByMedicalRecordCheck($request['medical_record_id']);
        if ($res != null) {
            return redirect()->back()->withErrors("message", "no rekam medic sudah digunakan gunakan");
        }
        if ($request['citizen'] == 'WNI') {
            $res = $this->service->storeWithAdmin(
                $request->validate(
                    [
                        'fullname' => ['required', 'string', 'min:4'],
                        'email' => ['required', 'email', 'unique:pattient,email'],
                        'gender' => ['required'],
                        'password' => ['required'],
                        'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:13'],
                        'address_RT' => ['required', 'numeric'],
                        'address_RW' => ['required', 'numeric'],
                        'address_desa' => ['required', 'string'],
                        'address_dusun' => ['required', 'string'],
                        'address_kecamatan' => ['required', 'string'],
                        'address_kabupaten' => ['required', 'string'],
                        'citizen' => ['required'],
                        'profession' => ['required'],
                        'date_birth' => ['required'],
                        'blood_group' => ['required'],
                        'place_birth' => ['required'],
                        'nik' => ['required', 'numeric', 'digits:16', 'unique:pattient,nik'],
                        "medical_record_id" => ["required"],
                        "id_registration_officer" => ['required']
                    ]
                )
            );
            if ($res['status']) {
                try {
                    //code...
                    Mail::to($request['email'])->send(new MailHelper($request['medical_record_id'], $request['fullname'], $request['email']));
                    return redirect()->back()->with("message", "gagal mengirim email");
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->with("message", "gagal mengirim email");
                }
            } else {
                return redirect()->back()->with("message", "gagal mengirim mendaftarkan passien");
            }
        } else {
            $res = $this->service->storeWithAdmin(
                $request->validate(
                    [
                        'fullname' => ['required', 'string', 'min:4'],
                        'email' => ['required', 'email', 'unique:pattient,email'],
                        'gender' => ['required'],
                        'password' => ['required'],
                        'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:13'],
                        'address_RT' => ['required', 'numeric'],
                        'address_RW' => ['required', 'numeric'],
                        'address_desa' => ['required', 'string'],
                        'address_dusun' => ['required', 'string'],
                        'address_kecamatan' => ['required', 'string'],
                        'address_kabupaten' => ['required', 'string'],
                        'citizen' => ['required'],
                        'profession' => ['required'],
                        'date_birth' => ['required'],
                        'blood_group' => ['required'],
                        'place_birth' => ['required'],
                        'no_paspor' => ['required', 'numeric', 'digits:16', 'unique:pattient,nik'],
                        "medical_record_id" => ["required"],
                        "id_registration_officer" => ['required']
                    ]
                )
            );
            if ($res['status']) {
                try {
                    //code...
                    Mail::to($request['email'])->send(new MailHelper($request['medical_record_id'], $request['fullname'], $request['email']));
                    return redirect()->back()->with("message", "gagal mengirim email");
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->with("message", "gagal mengirim email");
                }
            } else {
                return redirect()->back()->with("message", "gagal mengirim mendaftarkan passien");
            }
        }
    }
    public function show(Pattient $pattient)
    {
        $data = $this->service->findById($pattient->id);
        return $data;
    }
    public function edit(Pattient $pattient)
    {
        $data = $this->service->findById($pattient);
        // return view to edit , with data variable 
    }
    public function update(UpdatePattientRequest $request, Pattient $pattient)
    {
        $res = $this->service->update($request->validate($request->rules()), $pattient->id);
        if ($res['status']) {
            return view()->with("message", $res['message']);
        } else {
            return view()->with("message", $res['message']);
        }
    }

    public function destroy(Pattient $pattient)
    {
        // res boolean true if success false if not found
        $res = $this->service->deleteById($pattient->id);
    }

    public function oke()
    {
        dd("ok");
    }

    public function login(PattienLoginRequest $pattienLoginRequest)
    {

        $data = $pattienLoginRequest->validate($pattienLoginRequest->rules());
        $res = $this->service->login($data);
        if ($res) {
            return redirect('dashboard');
        }
    }

    public function showRecordDashboard($idMedicalRecord)
    {
        $res = $this->service->showRecordDashboard($idMedicalRecord);
        return $res;
    }
    public function showRecordHistory($idMedicalRecord){
        $res = $this->service->showRecordHistory($idMedicalRecord);
        return $res;
    }
}