<?php


namespace App\Services;

use App\Helpers\Helper;
use App\Models\Pattient;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isEmpty;

class PattientService
{


    private Pattient $model;

    public function __construct()
    {
        $this->model = new Pattient();
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
                } else if (array_key_exists("no_paspor", $request) &&  $key->no_paspor == $request['no_paspor']) {
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
}
