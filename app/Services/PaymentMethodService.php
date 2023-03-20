<?php

namespace App\Services;

use App\Models\PaymentMethod;

class PaymentMethodService
{

    private PaymentMethod $model;


    public function __construct()
    {
        $this->model = new PaymentMethod();
    }

    public function findAll()
    {
        // $this->banks = [
        //     [
        //         "id" => "BCA",
        //         "name" => "BCA ( Bank Central Asia )",
        //         "image" => "bca-logo.png",
        //         "no_card" => "623724239",
        //         "name_card" => "RUMAH SAKIT CITRA HUSADA JEMBER"
        //     ],
        //     [
        //         "id" => "BRI",
        //         "name" => "BRI ( Bank Rakyat Indonesia )",
        //         "image" => "bri-logo.png",
        //         "no_card" => "689564234",
        //         "name_card" => "RUMAH SAKIT CITRA HUSADA JEMBER"
        //     ]
        // ];
        $res = $this->model->all()->toArray();
        foreach ($res as $key => $value) {
            # code...
            $res[$key]['no_card'] = $res[$key]['no_rek'];
            $res[$key]['name_card'] = $res[$key]['atas_nama'];
            unset($res[$key]['no_rek'], $res[$key]['atas_nama']);

        }
        return $res;
    }

}

?>