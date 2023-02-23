<?php


namespace App\Services;

use App\Helpers\Helper;
use App\Mail\MailHelper;
use App\Models\MedicalRecords;
use App\Models\Pattient;
use App\Models\Record;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class MedicalRecordService
{

    private MedicalRecords $medicalRecords;
    private Pattient $pattient;
    private Record $record;

    public function __construct()
    {
        $this->medicalRecords = new MedicalRecords();
        $this->pattient = new Pattient();
        $this->record = new Record();
    }
    public function findAll()
    {

        $dataDetailRecord['detailRecord'] = $this->medicalRecords
        ->join("record" , "record.medical_record_id" , "=" , "medical_records.medical_record_id")
        ->join('schedule_detail' , 'record.id_schedules' , '=' , "schedule_detail.id")
        ->join('schedules' , 'schedule_detail.id_schedule' , '=' , 'schedules.id')
        ->join('doctor' , 'schedules.id_doctor' , '=' , 'doctor.id')
        ->select("record.complaint" , "record.description" , 'schedule_detail.consultation_date as tanggal_konsultasi' , 'schedule_detail.time_start as jam_mulai_konsultasi' , 'schedule_detail.time_end as jam_selesai_konsultasi' , 'schedule_detail.link as link_jitsi' , 'schedule_detail.status' , 'doctor.name as nama_doctor' )
        ->get()->toArray();
        $res = $this->pattient
            ->join("medical_records", "medical_records.id_pattient", "=", "pattient.id")
            ->leftjoin("record", "medical_records.medical_record_id", "=", "record.medical_record_id")
            ->join("registration_officers", "medical_records.id_registration_officer", "=", "registration_officers.id")
            ->select("pattient.*", "medical_records.medical_record_id",  "registration_officers.name as petugas_pendaftaran")
            ->groupBy("medical_records.medical_record_id")
            ->get()->toArray();
        foreach ($res as $key => $value) {
            array_push($res[$key], $dataDetailRecord['detailRecord']);
        }
        return $res;
    }
    public function insert(array $request)
    {
      
        $response = [];
        try {
            $res = $this->medicalRecords->create($request);
            if ($res) {
                $response['status'] = true;
                $response['payload'] = $request;
                return $response;
            }
            $response['status'] = false;
            $response['payload'] = null;
            return $response;
        } catch (\PDOException $th) {
            //throw $th;
            $response['status'] = false;
            $response['payload'] = null;
            dd($th);            return $response;
        }
    }
    public function update(array $request, $id)
    {
        $isChange = Helper::compareToArraysCustomId($request, $id, 'medical_records', 'medical_record_id');
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
        $res = $this->pattient
            ->join("medical_records", "medical_records.id_pattient", "=", "pattient.id")
            ->leftjoin("record", "medical_records.medical_record_id", "=", "record.medical_record_id")
            ->leftjoin('doctor', 'record.id_doctor', '=', 'doctor.id')
            ->join("registration_officers", "medical_records.id_registration_officer", "=", "registration_officers.id")
            ->where('medical_records.medical_record_id', $id)
            ->select("pattient.*", "medical_records.medical_record_id", "record.complaint", "record.description", 'doctor.name as doctor_name', "registration_officers.name as petugas_pendaftaran")
            ->groupBy('medical_records.medical_record_id')
            ->get()->toArray();
        $recordData['detailRecord'] = [];
        foreach ($res as $key => $value) {
            $item = [
                "complaint" => $value['complaint'],
                "description" => $value['description'],
                "doctor_name" => $value['doctor_name']
            ];
            array_push($recordData['detailRecord'], $item);
        }
        foreach ($res as $key => $value) {
            Arr::forget($value, "complaint");
            Arr::forget($value, "description");
            Arr::forget($value, "doctor_name");
            $res[$key] = $value;
        }
        foreach ($res as $key => $value) {
            array_push($res[$key], $recordData);
        }
        return $res;
    }

    public function deleteById($id)
    {
        $res = $this->medicalRecords->where('medical_record_id', $id)->delete();
        if ($res) {
            return true;
        }
        return false;
    }
    public function sendEmailMedicalRecord($id, $rekamMedic)
    {
        $findPattientByID = $this->pattient->where('id', $id)->first();
        if ($findPattientByID != null) {
            Mail::to($findPattientByID->email)->send(new MailHelper($rekamMedic, $findPattientByID->name, $findPattientByID->email));
            return true;
        } else {
            return false;
        }
    }
    public function sendEmailWithRegisterByAdmin($id, array $request)
    {
        $res = $this->insert($request);
        if ($res['status']) {
            $findPattientByID = $this->pattient->where('id', $id)->first();
            $rekamMedic = $res['payload']['rekamMedic'];
            if ($findPattientByID != null) {
                Mail::to($findPattientByID->email)->send(new MailHelper($rekamMedic, $findPattientByID->name, $findPattientByID->email));
                return true;
            } else {
                return false;
            }
        } else {

        }
    }
}