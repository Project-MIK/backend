<?php

namespace App\Http\Controllers;

use App\Http\Requests\PattienLoginRequest;
use App\Http\Requests\StorePattientMedicalRequest;
use App\Http\Requests\StorePattientRequest;
use App\Http\Requests\UpdatePattientRequest;
use App\Mail\EmailVerivication;
use App\Mail\MailHelper;
use App\Models\Pattient;
use App\Services\MedicalRecordService;
use App\Services\PattientService;
use App\Services\RecoveryAccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

use function PHPUnit\Framework\isEmpty;

class PattientController extends Controller
{

    private PattientService $service;
    private MedicalRecordService $medicalRecordService;

    private RecoveryAccountService $recoveryService;


    public function __construct()
    {
        $this->service = new PattientService();
        $this->medicalRecordService = new MedicalRecordService();
        $this->recoveryService = new RecoveryAccountService();
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
            $request['citizen'] = 'WNI';
            $res = $this->service->store($request->validate([
                'fullname' => ['required', 'string', 'min:4'],
                'email' => ['required', 'email', 'unique:pattient,email'],
                'gender' => ['required'],
                'password' => ['required'],
                'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:13'],
                'address_RT' => ['required', 'numeric', 'digits:3'],
                'address_RW' => ['required', 'numeric', 'digits:3'],
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
                'address_RT' => ['required', 'numeric', 'digits:3'],
                'address_RW' => ['required', 'numeric', 'digits:3'],
                'address_desa' => ['required', 'string'],
                'address_dusun' => ['required', 'string'],
                'address_kecamatan' => ['required', 'string'],
                'address_kabupaten' => ['required', 'string'],
                'citizen' => ['required'],
                'profession' => ['required'],
                'date_birth' => ['required'],
                'blood_group' => ['required'],
                'place_birth' => ['required'],
                'no_paspor' => ['required', 'digits:16', 'unique:pattient,no_paspor']
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
        $idAdmin = Auth::guard('admin')->user()->id;
        $request['id_admin'] = $idAdmin;
        unset($request['id_registration_officer']);
        $rules = [
            'medical_record_id' => ['required', 'digits:6'],
        ];

        $customMessages = [
            'required' => 'rekam medic tidak boleh kosong',
            "digits:6" => "rekam medic hanya boleh sepanjang 6 digit"
        ];
        $this->validate($request, $rules, $customMessages);
        $res = $this->medicalRecordService->findByMedicalRecordCheck($request['medical_record_id']);

        if ($res != null) {
            return redirect()->back()->withErrors("no rekam medic sudah digunakan gunakan");
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
                        "id_admin" => ['required']
                    ]
                )
            );
            if ($res['status']) {
                try {
                    //code...
                    Mail::to($request['email'])->send(new MailHelper($request['medical_record_id'], $request['fullname'], $request['email']));
                    return redirect('admin/pasien')->with("message", "berhasil mengirim email");
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->withErrors("gagal mengirim email");
                }
            } else {
                return redirect()->back()->withErrors("gagal mengirim mendaftarkan passien");
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
                        'paspor' => ['required', 'numeric', 'digits:16', 'unique:pattient,nik'],
                        "medical_record_id" => ["required"],
                        "id_admin" => ['required']
                    ]
                )
            );
            if ($res['status']) {
                try {
                    //code...
                    Mail::to($request['email'])->send(new MailHelper($request['medical_record_id'], $request['fullname'], $request['email']));
                    return redirect('admin/pasien')->with("message", "berhasil mengirim email");
                } catch (\Throwable $th) {
                    //throw $th;
                    return redirect()->back()->withErrors("gagal mengirim email");
                }
            } else {
                return redirect()->back()->withErrors("gagal mengirim mendaftarkan passien");
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
            return redirect('dashboard')->with('message', 'berhasil login');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Password atau No Rekam Medik Salah']);
        }
    }

    public function showRecordDashboard($idMedicalRecord)
    {
        $res = $this->service->showRecordDashboard($idMedicalRecord);

        return $res;
    }
    public function showRecordHistory($idMedicalRecord)
    {
        $res = $this->service->showRecordHistory($idMedicalRecord);
        return $res;
    }
    public function changeEmail(Request $request)
    {

        $rules = [
            'email' => ['required', 'email', 'unique:pattient,email'],
        ];

        $customMessages = [
            'required' => ':attribute field tidak boleh kosong.',
            'unique' => 'email sudah digunakan coba gunakan email yang lain'
        ];

        $this->validate($request, $rules, $customMessages);

        if (Auth::guard('pattient')->check()) {
            $id = Auth::guard('pattient')->user()->id;
            $isUpdate = $this->service->changeEmail($id, $request->email);
            if ($isUpdate) {
                Auth::guard('pattient')->logout();
                return redirect("/masuk")->with('message', 'berhasil mengganti email silahkan login ulang');
            } else {
                return redirect()->back()->with('message', 'gagal mengganti email terjadi kesalahan');
            }
        } else {
            Auth::guard('pattient')->logout();
            return redirect("/masuk")->with('message', 'session habis silahkan login terlebih dahulu');
        }
    }

    public function changePassword(Request $request)
    {
        $pw1 = $request->password1;
        $pw2 = $request->password2;
        if ($pw1 != $pw2) {
            return redirect()->back()->withErrors("Password Dan Konfirmasi Password Harus Sama");
        }

        if (Auth::guard('pattient')->check()) {
            $id = Auth::guard('pattient')->user()->id;
            $isUpdate = $this->service->changePassword($id, $pw1);
            if ($isUpdate) {
                Auth::guard('pattient')->logout();
                return redirect("/masuk")->with('message', 'berhasil mengganti password silahkan login ulang');
            } else {
                return redirect()->back()->with('message', 'gagal mengganti password terjadi kesalahan');
            }
        } else {
            Auth::guard('pattient')->logout();
            return redirect("/masuk")->with('message', 'session habis silahkan login terlebih dahulu');
        }
    }

    public function updateDataPattient(Request $request)
    {
        $id = $request->id;
        $rules = [
            'fullname' => ['required', 'min:4'],
            'address_RT' => ['required', 'min:2', 'max:3'],
            'address_RW' => ['required', 'min:2', 'max:3'],
            'address_Desa' => ['required', 'max:20', 'min:4'],
            'address_kecamatan' => ['required', 'max:20', 'min:4'],
            'address_kabupaten' => ['required', 'max:20', 'min:4'],
            'number_phone' => ['required', 'min:10', 'max:13'],
        ];
        if ($request->citizen == 'WNI') {
            $rules['nik'] = ['required', 'digits:16'];
            $customMessages = [
                'fullname.required' => 'Nama lengkap tidak boleh kosong.',
                'fullname.min' => 'Nama lengkap tidak boleh kurang dari 4 digit',
                'address_RT.required' => 'RT tidak boleh kosong',
                'address_RT.min' => 'RT tidak boleh kurang dari 2 digit',
                'address_RT.max' => 'RT tidak boleh lebih dari 3 digit',
                'address_Desa.required' => 'Desa tidak boleh kosong',
                'address_Desa.max' => 'Desa tidak boleh lebih dari 20 digit',
                'address_Desa.min' => 'Desa tidak boleh kurang dari 4 digit',
                'address_kecamatan.required' => 'Kecamatan tidak boleh kosong',
                'address_kecamatan.min' => 'Kecamatan tidak boleh kurang dari 4 digit',
                'address_kecamatan.max' => 'Kecamatan tidak boleh lebih dari 20 digit',
                'address_kabupaten.required' => 'Kabupaten tidak boleh kosong',
                'address_kabupaten.max' => 'Kabupaten tidak boleh lebih dari 20 digit',
                'address_kabupaten.min' => 'kabupaten tidak boleh kurang dari 4 digit',
                'number_phone.required' => 'No Hp tidak boleh kosong',
                'number_phone.min' => 'no Hp tidak boleh kurang dari 10 digit',
                'number_phone.max' => 'no Hp tidak boleh lebih dari 13 digit'
            ];
            $this->validate($request, $rules, $customMessages);
            $checkNik = $this->service->checkNik($id, $request->nik);
            // jika checknik true maka nik tidak ada yang digunakan
            $this->validate($request, $rules, $customMessages);
            if ($checkNik) {
                return redirect()->back()->withErrors(['msg' => 'nik sudah digunakan olah pengguna lain']);
            }
        } else {
            $checkPaspor = $this->service->checkNoPaspor($id, $request->no_paspor);
            if ($checkPaspor) {
                return redirect()->back()->withErrors(['msg' => 'no paspor sudah digunakan olah pengguna lain']);
            }
            $rules['no_paspor'] = ['required', 'digits:16', 'unique:pattient,no_paspor'];
            $customMessages = [
                'fullname.required' => 'Nama lengkap tidak boleh kosong.',
                'fullname.min' => 'Nama lengkap tidak boleh kurang dari 4 digit',
                'address_RT.required' => 'RT tidak boleh kosong',
                'address_RT.min' => 'RT tidak boleh kurang dari 2 digit',
                'address_RT.max' => 'RT tidak boleh lebih dari 3 digit',
                'address_Desa.required' => 'Desa tidak boleh kosong',
                'address_Desa.max' => 'Desa tidak boleh lebih dari 20 digit',
                'address_Desa.min' => 'Desa tidak boleh kurang dari 4 digit',
                'address_kecamatan.required' => 'Kecamatan tidak boleh kosong',
                'address_kecamatan.min' => 'Kecamatan tidak boleh kurang dari 4 digit',
                'address_kecamatan.max' => 'Kecamatan tidak boleh lebih dari 20 digit',
                'address_kabupaten.required' => 'Kabupaten tidak boleh kosong',
                'address_kabupaten.max' => 'Kabupaten tidak boleh lebih dari 20 digit',
                'address_kabupaten.min' => 'kabupaten tidak boleh kurang dari 4 digit',
                'number_phone.required' => 'No Hp tidak boleh kosong',
                'number_phone.min' => 'no Hp tidak boleh kurang dari 10 digit',
                'number_phone.max' => 'no Hp tidak boleh lebih dari 13 digit'
            ];
            $this->validate($request, $rules, $customMessages);
        }
        $data = $request->except([
            'address_RT',
            'address_RW',
            'address_Dusun',
            'address_Desa',
            'address_kecamatan',
            'address_kabupaten',
            'number_phone',
            'fullname',
            'birth_date',
            '_token',
            'email'
        ]);
        $data['date_birth'] = $request->birth_date;
        $data['name'] = $request->fullname;
        $data['address'] = $request->address_RT . '/' . $request->address_RW . '/' . $request->address_Dusun . '/' . $request->address_Desa . '/' . $request->address_kecamatan . '/' . $request->address_kabupaten;
        $data['phone_number'] = $request->number_phone;
        $res = $this->service->updateDataPattient($data, $id);
        if ($res) {
            return redirect()->back()->with('message', 'berhasil memperbarui data');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Gagal Memperbarui Tidak ada perubahan data']);
        }
    }




    public function findByIdInaAdmin($id)
    {
        $data = $this->service->findByIdInAdmin($id);
        if (sizeof($data) > 0) {
            return view('admin.pasien-detail', ["data" => $data]);
        }
        return redirect('/admin/pasien');
    }

    public function updatePatientInAdmin(Request $request)
    {
        $id = 1;
        $rules = [
            'fullname' => ['required', 'min:4'],
            'address_RT' => ['required', 'min:2', 'max:3'],
            'address_RW' => ['required', 'min:2', 'max:3'],
            'address_desa' => ['required', 'max:20', 'min:4'],
            'address_kecamatan' => ['required', 'max:20', 'min:4'],
            'address_kabupaten' => ['required', 'max:20', 'min:4'],
            'no_telp' => ['required', 'min:10', 'max:13'],
        ];
        if ($request->citizen == 'WNI') {
            $rules['nik'] = ['required', 'digits:16'];
            $customMessages = [
                'fullname.required' => 'Nama lengkap tidak boleh kosong.',
                'fullname.min' => 'Nama lengkap tidak boleh kurang dari 4 digit',
                'address_RT.required' => 'RT tidak boleh kosong',
                'address_RT.min' => 'RT tidak boleh kurang dari 2 digit',
                'address_RT.max' => 'RT tidak boleh lebih dari 3 digit',
                'address_desa.required' => 'Desa tidak boleh kosong',
                'address_desa.max' => 'Desa tidak boleh lebih dari 20 digit',
                'address_desa.min' => 'Desa tidak boleh kurang dari 4 digit',
                'address_kecamatan.required' => 'Kecamatan tidak boleh kosong',
                'address_kecamatan.min' => 'Kecamatan tidak boleh kurang dari 4 digit',
                'address_kecamatan.max' => 'Kecamatan tidak boleh lebih dari 20 digit',
                'address_kabupaten.required' => 'Kabupaten tidak boleh kosong',
                'address_kabupaten.max' => 'Kabupaten tidak boleh lebih dari 20 digit',
                'address_kabupaten.min' => 'kabupaten tidak boleh kurang dari 4 digit',
                'no_telp.required' => 'No Hp tidak boleh kosong',
                'no_telp.min' => 'no Hp tidak boleh kurang dari 10 digit',
                'no_telp.max' => 'no Hp tidak boleh lebih dari 13 digit'
            ];
            $checkNik = $this->service->checkNik($id, $request->nik);
            // jika checknik true maka nik tidak ada yang digunakan
            $this->validate($request, $rules, $customMessages);
            if ($checkNik) {
                return redirect()->back()->withErrors(['msg' => 'nik sudah digunakan olah pengguna lain']);
            }
        } else {
            $checkPaspor = $this->service->checkNoPaspor($id, $request->no_paspor);
            if ($checkPaspor) {
                return redirect()->back()->withErrors(['msg' => 'no paspor sudah digunakan olah pengguna lain']);
            }
            $rules['no_paspor'] = ['required', 'digits:16', 'unique:pattient,no_paspor'];
            $customMessages = [
                'fullname.required' => 'Nama lengkap tidak boleh kosong.',
                'fullname.min' => 'Nama lengkap tidak boleh kurang dari 4 digit',
                'address_RT.required' => 'RT tidak boleh kosong',
                'address_RT.min' => 'RT tidak boleh kurang dari 2 digit',
                'address_RT.max' => 'RT tidak boleh lebih dari 3 digit',
                'address_Desa.required' => 'Desa tidak boleh kosong',
                'address_Desa.max' => 'Desa tidak boleh lebih dari 20 digit',
                'address_Desa.min' => 'Desa tidak boleh kurang dari 4 digit',
                'address_kecamatan.required' => 'Kecamatan tidak boleh kosong',
                'address_kecamatan.min' => 'Kecamatan tidak boleh kurang dari 4 digit',
                'address_kecamatan.max' => 'Kecamatan tidak boleh lebih dari 20 digit',
                'address_kabupaten.required' => 'Kabupaten tidak boleh kosong',
                'address_kabupaten.max' => 'Kabupaten tidak boleh lebih dari 20 digit',
                'address_kabupaten.min' => 'kabupaten tidak boleh kurang dari 4 digit',
                'number_phone.required' => 'No Hp tidak boleh kosong',
                'number_phone.min' => 'no Hp tidak boleh kurang dari 10 digit',
                'number_phone.max' => 'no Hp tidak boleh lebih dari 13 digit'
            ];
            //$ok =  $this->validate($request, $rules, $customMessages);
        }
        $data = $request->except([
            'address_RT',
            'address_RW',
            'address_dusun',
            'address_desa',
            'address_kecamatan',
            'address_kabupaten',
            'no_telp',
            'fullname',
            'date_birth',
            '_token',
            'email',
            'gender',
            '_method',
            'password'
        ]);
        $data['date_birth'] = $request->date_birth;
        $data['name'] = $request->fullname;
        $data['address'] = $request->address_RT . '/' . $request->address_RW . '/' . $request->address_Dusun . '/' . $request->address_Desa . '/' . $request->address_kecamatan . '/' . $request->address_kabupaten;
        $data['phone_number'] = $request->no_telp;
        $data['gender'] = $request->gender == 'female' ? 'W' : 'M';
        $res = $this->service->updateDataPattient($data, $id);
        if ($res) {
            return redirect()->back()->with('message', 'berhasil memperbarui data');
        } else {
            echo "failed";
            return redirect()->back()->withErrors(['msg' => 'Gagal Memperbarui Tidak ada perubahan data']);
        }
    }

    public function logout()
    {
        Auth::guard('pattient')->logout();
        return redirect('/masuk');
    }

    public function showDataAction($id)
    {
        $data = $this->service->showDataActionConsultation($id);
        if (sizeof($data) == 0) {
            return redirect()->back()->withErrors("id konsultasi tidak ditemukan");
        } else {
            return view("pacient.consultation.detail-consultation", $data);
        }
    }
    public function sendEmailVerivikasi(Request $request)
    {
        $res = $this->service->sendEmailVerivikasi($request->email);
        if ($res != null) {
            $id = $res->id;
            $res = $this->recoveryService->insert($id);
            Mail::to($request->email)->send(new EmailVerivication($res->token, $request->email));
            return redirect()->back()->with("message", "berhasil mengirimkan email");
        } else {
            return redirect("/lupa-sandi")->withErrors("Gagal mengirmkan email , email tidak terdaftar");
        }
    }
    // ubah di web.php
    public function forgot_pasword(Request $request)
    {
        $password1 = $request->password1;
        $password2 = $request->password2;
        if ($password1 != $password2) {
            return redirect("recovery/" . $request->token_recovery)->withErrors("Password dan Konfirmasi Password harus sama");
        }
        $res = $this->service->forgot_pasword($request->token_recovery, $request->password);
        if ($res) {
            return redirect('masuk')->with('message', 'berhasil memperbarui kata sandi , silahkan login');
        }
        return redirect("recovery/" . $request->token_recovery)->withErrors("Gagal memperbarui kata sandi terjadi kesalahan");
    }

    public function checkTokenValid($token)
    {
        $isValid = $this->recoveryService->checkTokenValid($token);
        if ($isValid['status']) {
            return view("pacient.auth.recovery", compact("token"));
        }
        return redirect('lupa-sandi')->withErrors($isValid['message']);
    }

    public function kirimRekamMedic(Request $request)
    {
        $request->validate([
            "medical_record_id" => ['required' , 'digits:6']
        ]);
        $response = $this->service->kirimRekamMedic($request['medical_record_id'], $request['email'], Auth::guard('admin')
        ->user()->id);
        if($response['status']){
            Mail::to($request['email'])->send(new MailHelper($request['medical_record_id'], $request['fullname'] ==null ? "anonymous" : $request['fullname'], $request['email']));
            return redirect()->back()->with('message'  , $response['message']);
        }else{
            return redirect()->back()->withErrors($response['message']);
        }   
       
    }




}