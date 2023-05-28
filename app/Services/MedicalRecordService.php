<?php


namespace App\Services;

use App\Helpers\Helper;
use App\Mail\MailHelper;
use App\Models\MedicalRecords;
use App\Models\Pattient;
use App\Models\Record;
use Carbon\Carbon;
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
            ->join("record", "record.medical_record_id", "=", "medical_records.medical_record_id")
            ->join('schedule_detail', 'record.id_schedules', '=', "schedule_detail.id")
            ->join('schedules', 'schedule_detail.id_schedule', '=', 'schedules.id')
            ->join('doctor', 'schedules.id_doctor', '=', 'doctor.id')
            ->select("record.complaint", "record.description", 'schedule_detail.consultation_date as tanggal_konsultasi', 'schedule_detail.time_start as start_consultation', 'schedule_detail.time_end as end_consultation', 'schedule_detail.link as link_jitsi', 'record.status', 'doctor.name as nama_doctor')
            ->get()->toArray();

        foreach ($dataDetailRecord['detailRecord'] as $key => $value) {
            # code...
            $dataDetailRecord['detailRecord'][$key]['valid_status']
                = Carbon::now()->greaterThan(Carbon::parse($dataDetailRecord['detailRecord'][$key]['end_consultation']));
        }
        $res = $this->pattient
            ->join("medical_records", "medical_records.medical_record_id", "=", "pattient.medical_record_id")
            ->leftjoin("record", "medical_records.medical_record_id", "=", "record.medical_record_id")
            ->join("registration_officers", "medical_records.id_registration_officer", "=", "registration_officers.id")
            ->select("pattient.name" , 'pattient.email' , 'pattient.gender' , 'pattient.phone_number' , 'pattient.address' , 'pattient.citizen' , 'pattient.profession' , 'pattient.date_birth' , 'pattient.place_birth' , 'pattient.medical_record_id' , 'pattient.blood_group' , 'pattient.no_paspor' , 'pattient.nik', "medical_records.medical_record_id", "registration_officers.name as petugas_pendaftaran")
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
          
            return $response;
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
    public function findByMedicalRecord($id)
    {
        $dataDetailRecord['detailRecord'] = $this->medicalRecords
            ->join("record", "record.medical_record_id", "=", "medical_records.medical_record_id")
            ->join('schedule_detail', 'record.id_schedules', '=', "schedule_detail.id")
            ->join('schedules', 'schedule_detail.id_schedule', '=', 'schedules.id')
            ->join('doctor', 'schedules.id_doctor', '=', 'doctor.id')
            ->select("record.complaint", "record.description", 'schedule_detail.consultation_date as tanggal_konsultasi', 'schedule_detail.time_start as start_consultation', 'schedule_detail.time_end as end_consultation', 'schedule_detail.link as link_jitsi', 'record.status', 'doctor.name as nama_doctor')
            ->get()->toArray();

        foreach ($dataDetailRecord['detailRecord'] as $key => $value) {
            # code...
            $dataDetailRecord['detailRecord'][$key]['valid_status']
                = Carbon::now()->greaterThan(Carbon::parse($dataDetailRecord['detailRecord'][$key]['end_consultation']));
        }
        $res = $this->pattient
            ->join("medical_records", "medical_records.medical_record_id", "=", "pattient.medical_record_id")
            ->leftjoin("record", "medical_records.medical_record_id", "=", "record.medical_record_id")
            ->join("registration_officers", "medical_records.id_registration_officer", "=", "registration_officers.id")
            ->where('pattient.medical_record_id', $id)
            ->select("pattient.name" , 'pattient.email' , 'pattient.gender' , 'pattient.phone_number' , 'pattient.address' , 'pattient.citizen' , 'pattient.profession' , 'pattient.date_birth' , 'pattient.place_birth' , 'pattient.medical_record_id' , 'pattient.blood_group' , 'pattient.no_paspor' , 'pattient.nik', "medical_records.medical_record_id", "registration_officers.name as petugas_pendaftaran")
            ->groupBy("medical_records.medical_record_id")
            ->get()->toArray();
        foreach ($res as $key => $value) {
            array_push($res[$key], $dataDetailRecord['detailRecord']);
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
    
    public function findByMedicalRecordCheck($id){
        return $this->medicalRecords->Where('medical_record_id' ,$id)->first();
    }
}