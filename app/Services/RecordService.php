<?php


namespace App\Services;

use App\Helpers\Helper;
use App\Models\MedicalRecords;
use App\Models\Record;

class RecordService
{


    private Record $record;
    private MedicalRecords $medicalRecord;


    public function __construct()
    {
        $this->record = new Record();
        $this->medicalRecord = new MedicalRecords();
    }

    public function index()
    {
        return $this->record->all()->toArray();
    }

    public function insert(array $request)
    {
        $res = $this->record->create($request);
        return $res;
    }

    public function findByMedicalRecord($rekamMedic)
    {
        $res = $this->record->where("medical_record_id", $rekamMedic)->get()->toArray();
        return $res;
    }

    public function findById($id)
    {
        return $this->record->where('id', $id)->first();
    }

    public function update(array $request, $id)
    {
        $res = [];
        $check = Helper::compareToArrays($request, $id, "record");
        if ($check) {
            $responseUpdate = $this->record->where('id', $id)->
                update([
                    "complaint" => $request['complaint'],
                    "description" => $request['description']
                ]);
            if ($responseUpdate) {
                $res['status'] = true;
                $res['message'] = "berhasil memperbarui detail rekam medic";
                return $res;
            }
            $res['status'] = true;
            $res['message'] = 'gagal memperbarui detail rekam medic , terjadi kesalahan';
            return $res;
        } else {
            $res['status'] = false;
            $res['message'] = "gagal memperbarui detail rekam medis , tidak ada perubahan";
            return $res;
        }
    }


    public function delete($id)
    {
        $res =[];
        $check = $this->record->where('id', $id)->get();
        if($check){
            $this->record->where("id" , $id)->delete();
            $res['status'] = true;
            $res['message'] = "berhasil menghapus detail rekam medic";
            return $res;
        }else{
            $res['status'] = false;
            $res['message'] = "gagal menghapus detail rekam medic , detail rekam medic tidak ditemukan";
            return $res;
        }
    }

}

?>