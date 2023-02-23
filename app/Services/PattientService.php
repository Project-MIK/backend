<?php


namespace App\Services;

use App\Helpers\Helper;
use App\Models\MedicalRecords;
use App\Models\Pattient;
use Illuminate\Support\Facades\Auth;
use Sarav\Multiauth\MultiauthServiceProvider;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isEmpty;

class PattientService
{


    private Pattient $model;
    private MedicalRecords $medicalRecords;
    private MedicalRecordService $medicalRecordService;

    public function __construct()
    {
        $this->medicalRecordService = new MedicalRecordService();
        $this->model = new Pattient();
        $this->medicalRecords = new MedicalRecords();
    }

    public function findAll()
    {
        $data = $this->model->all()->toArray();
        return $data;
    }
    public function store(array $request)
    {
        try {
            $request['password'] = bcrypt($request['password']);
            $request['name'] = $request['fullname'];
            $request['address'] = "RT/RW : " . $request['address_RT'] . "/" . $request['address_RW'] . " Dusun " . $request['address_dusun'] . " Desa " . $request['address_desa'] . " Kec. " . $request['address_kecamatan'] . " Kab." . $request['address_kabupaten'];
            $res = $this->model->create($request);
            if ($res) {
                return true;
            }
            return false;
        } catch (ValidationException $ex) {
            return false;
        }
    }

    public function storeWithAdmin(array $request)
    {
        $res = [];
        try {
            $request['password'] = bcrypt($request['password']);
            $request['name'] = $request['fullname'];
            $request['address'] = "RT/RW : " . $request['address_RT'] . "/" . $request['address_RW'] . " Dusun " . $request['address_dusun'] . " Desa " . $request['address_desa'] . " Kec. " . $request['address_kecamatan'] . " Kab." . $request['address_kabupaten'];
            $response = $this->model->create($request);
            $findRekamMedic = $this->medicalRecords->where('medical_record_id', $request['medical_record_id'])->first();
            if($findRekamMedic !=null){
                $res['status'] = false;
                $res['message'] = 'gagal menambahkan rekam medic no rekam medic tidak boleh sama';
                return $res;
            }
            if ($response) {
                $dataRekamMedic = [
                    "medical_record_id" => $request['medical_record_id'],
                    "id_registration_officer" => $request['id_registration_officer']
                ];
                $insertRekamMedic = $this->medicalRecordService->insert(
                    $dataRekamMedic
                );
                if ($insertRekamMedic['status']) {
                    $resUpdate = $this->model->where('id', $response->id)->update(
                        [
                            'medical_record_id' => $request['medical_record_id']
                        ]
                    );
                    if ($resUpdate) {
                        $this->medicalRecordService->sendEmailMedicalRecord(
                            $response->id, $request['medical_record_id']
                        );
                        $res['status'] = true;
                        $res['message'] = 'berhasil menambahkan patient , berhasil mengirimkan email';
                        return $res;
                    } else {
                        $res['status'] = false;
                        $res['message'] = 'gagal memberikan rekam medic , terjadi kesalahan';
                        return $res;
                    }
                } else {
                    $res['status'] = false;
                    $res['message'] = 'gagal menambahkan rekam medic , terjadi kesalahan';
                    return $res;
                }
            } else {
                $this->medicalRecords->where('id', $request['medical_record_id'])->delete();
                $res['status'] = false;
                $res['message'] = "gagal menambahka passient";
                return $res;
            }
        } catch (ValidationException $ex) {
            $res['status'] = false;
            $res['message'] = 'terjadi kesalahan server';
            return $res;
        }

    }



    public function findById($id)
    {
        $res = $this->model->where('id', $id)->get()->toArray();
        return $res;
    }
    // return array 
    public function update(array $request, $id): array
    {
        $data = $this->findById($id);
        $allData = $this->model->where('id', '<>', $id)->get();
        $isChanged = Helper::compareToArrays($request, $id, 'pattient');
        if ($isChanged) {
            $response = [];
            foreach ($allData as $key) {
                # code...
                if ($key->email == $request['email']) {
                    // check if value for email same with another acount
                    $response['status'] = false;
                    $response['message'] = 'email sudah digunakan silahkan coba email yang lain';
                    return $response;
                } else if (array_key_exists("nik", $request) && $key->nik == $request['nik']) {
                    $response['status'] = false;
                    $response['message'] = 'nik sudah digunakan silahkan coba nik yang valid';
                    return $response;
                } else if (array_key_exists("no_paspor", $request) && $key->no_paspor == $request['no_paspor']) {
                    $response['status'] = false;
                    $response['message'] = 'no paspor sudah digunakan silahkan coba no paspor yang valid';
                    return $response;
                }
            }
            if ($data == null) {
                $response['status'] = false;
                $response['message'] = 'data tidak ditemukan';
                return $response;
            } else {
                $res = $this->model->where('id', $id)->update($request);
                if ($res) {
                    $response['status'] = true;
                    $response['message'] = 'berhasil memperbarui data pasien';
                    return $response;
                } else {
                    $response['status'] = false;
                    $response['message'] = 'gagal memperbarui data pasien terjadi kesalahan server';
                    return $response;
                }
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'tidak ada perubahan data';
            return $response;
        }
    }

    public function forgotPassword(array $rquest, $id)
    {
        // $res =  $this->model->where('id', $id)->update($rquest);
    }
    public function deleteById($id)
    {
        $res = $this->model->where('id', $id)->delete();
        if ($res) {
            return true;
        }
        return false;
    }

    public function login(array $request)
    {
        $res = Auth::guard('pattient')->attempt(['medical_record_id' => $request['no_medical_records'], 'password' => $request['password']]);

        return $res;
    }

    public function showDataLogin($id)
    {

    }


}