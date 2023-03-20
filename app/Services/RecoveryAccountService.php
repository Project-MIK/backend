<?php

namespace App\Services;

use App\Models\RecoveryAccount;
use Carbon\Carbon;

class RecoveryAccountService
{


    private RecoveryAccount $model;


    public function __construct()
    {
        $this->model = new RecoveryAccount();
    }

    public function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
    public function insert($id)
    {
        $checkPattient = $this->model->where('id_pattient', $id)->first();
        if ($checkPattient != null) {
            $this->model->where('id_pattient', $id)->delete();
            $token = $this->quickRandom();
            $res = $this->model->create(
                [
                    "token" => $token,
                    "expired" => Carbon::now()->addHours(1),
                    "id_pattient" => $id
                ]
            );
        } else {
            $token = $this->quickRandom();
            $res = $this->model->create(
                [
                    "token" => $token,
                    "expired" => Carbon::now()->addHours(1),
                    "id_pattient" => $id
                ]
            );
        }
        return $res;
    }

    public function checkTokenValid($token)
    {
        $response = [];
        $data = $this->model->where('token', $token)->first();
        if ($data != null) {
            $expired = $data->expired;
            $expiredToken = strtotime($expired);
            if(time() >= $expiredToken){
                $response['status'] = false;
                $response['message'] = 'token sudah tidak valid , silahkan kirim token kembali dengan memasukan email yang sudah terdaftar';
                return $response;
            }
            $response['status'] = true;
            $response['message'] = 'token is valid';
            return $response;
        }
        $response['status'] = false;
        $response['message'] = 'token tidak valid , token tidak ditemukan silahkan kitim token kembali dengan memasukan email yang sudah terdaftar';
        return $response;
    }


}


?>