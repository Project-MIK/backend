<?php


namespace App\Services;

use App\Helpers\Helper;
use App\Models\MedicalRecords;

class MedicalRecordService
{

    private MedicalRecords $model;


    public function __construct()
    {
        $this->model = new MedicalRecords();
    }


    public function index()
    {
        return $this->model->all()->toArray();
    }


    public function insert(array $request)
    {
        $res = $this->model->create($request);
        if ($res) {
            return true;
        }
        return false;
    }

    public function update(array $request, $id)
    {
        $isChange = Helper::compareToArrays($request, $id, 'medical_recors');
        $response = [];
        if ($isChange) {
            $res = $this->model->where('id', $id)->update(
                $request
            );
            if ($res) {
                $response['status'] = true;
                $response['message'] = 'berhasil memperbarui data rekam medic';
            } else {
                $response['status'] = false;
                $response['message'] = 'gagal memperbarui data rekam medic terjadi kesalahan server';
            }
        } else {
            $response['status'] = false;
            $response['message'] = 'gagal memperbarui data rekam medic , tidak ada perubahan';
        }
        return $response;
    }

    public function findById($id)
    {
        return $this->model->where('id' , $id)->first()->toArray();
    }

    public function deleteById($id)
    {   
        $res = $this->model->where('id' , $id)->delete();
        if($res){
            return true;
        }
        return false;
    }
}
