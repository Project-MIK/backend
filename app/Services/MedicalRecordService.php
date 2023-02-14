<?php


namespace App\Services;

use App\Helpers\Helper;
use App\Models\MedicalRecords;
use App\Models\Pattient;

class MedicalRecordService
{

    private MedicalRecords $medicalRecords;
    private Pattient $pattient;
    

    public function __construct()
    {
        $this->medicalRecords = new MedicalRecords();
    }


    public function findAll()
    {
        return $this->medicalRecords->all()->toArray();
    }


    public function insert(array $request)
    {
        try {
            $res = $this->medicalRecords->create($request);
            if ($res) {
                return true;
            }
            return false;
        } catch (\PDOException $th) {
            //throw $th;
            return false;
        }
    }

    public function update(array $request, $id)
    {
        $isChange = Helper::compareToArraysCustomId($request, $id, 'medical_records' , 'medical_record_id');
        $response = [];
        if ($isChange) {
            $res = $this->medicalRecords->where('medical_record_id', $id)->update(
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
        $res =  $this->medicalRecords->where('medical_record_id', $id)->first();
        return $res == null ? [] : $res->toArray();
    }

    public function deleteById($id)
    {
        $res = $this->medicalRecords->where('medical_record_id', $id)->delete();
        if ($res) {
            return true;
        }
        return false;
    }
}
