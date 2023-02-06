<?php


namespace App\Services;

use App\Models\Pattient;
use Illuminate\Validation\ValidationException;

class PattientService
{


    private Pattient $model;


    public function __construct()
    {
        $this->model = new Pattient();
    }

    public function findAll()
    {
        $data = $this->model->all();
        return $data;
    }


    public function store(array $request)
    {
        try {
            $request['password'] = bcrypt($request['password']);
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
        $res = $this->model->where('id', $id)->first();
        return $res;
    }

    public function update(array $request, $id): array
    {
        $data = $this->findById($id);
        $allData = $this->model->where('id', '<>', $id)->get();
        $response = [];
        foreach ($allData as $key) {
            # code...
            if ($key->email == $request['email']) {
                // check if value for email same with another acount
                $response['status'] = false;
                $response['message'] = 'email sudah digunakan silahkan coba email yang lain';
                return $response;
            }
        }
        if ($data == null) {
            $response['status'] = 'false';
            $response['message'] = 'data tidak ditemukan';
            return $response;
        } else {
            $res = $this->model->where('id', $id)->update($request);
            if ($res) {
                $response['status'] = true;
                $response['message'] = 'berhasil memperbarui data pasien';
                return $response;
            } else {
                $response['status'] = 'false';
                $response['message'] = 'gagal memperbarui data pasien terjadi kesalahan server';
                return $response;
            }
        }
    }
}
