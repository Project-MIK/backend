<?php


namespace App\Services;

use App\Helpers\Helper;
use App\Models\Doctor;
use App\Models\MedicalRecords;
use App\Models\Record;
use App\Models\ScheduleDetail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecordService
{

    private Record $record;
    private MedicalRecords $medicalRecord;
    private Doctor $doctor;

    private ScheduleDetail $schedule;


    public function __construct()
    {
        $this->record = new Record();
        $this->medicalRecord = new MedicalRecords();
        $this->doctor = new Doctor();
        $this->schedule = new ScheduleDetail();
    }

    public function index()
    {
        return $this->record->all()->toArray();
    }

    public function insert(array $request)
    {
        //KL6584690
        $resultId = "";
        do {
            # code...
            $prefix = "KL";
            $randomString = random_int(1000000 , 9999999);
            $resultId = $prefix.$randomString;
            $uniqueid  = $this->record->where('id' , $resultId)->first();
        } while ($uniqueid != null);
        $res = [];
        $exist = $this->medicalRecord->where('medical_record_id', $request['medical_record_id'])->first();
        if ($exist == null) {
            $res['status'] = false;
            $res['message'] = 'gagal menambahkan detail rekam medic , rekam medic tidak ditemukan';
            return $res;
        } else {
            $existDoctor = $this->doctor->where('id', $request['id_doctor'])->first();
            if ($existDoctor == null) {
                $res['status'] = false;
                $res['message'] = 'gagal menambahkan detail rekam medic , data doktor tidak ditemukan';
                return $res;
            } else {
                $existSchedule = $this->schedule->where('id', $request['id_schedules'])->first();
                if($existSchedule!=null){
                    if($existSchedule->status !="kosong"){
                        $res['status'] =false;
                        $res['message'] = 'gagal menambahkan record , jadwal yang anda pilih tidak sedang kosong';
                        return $res;
                    }
                    $request['id'] = $resultId;
                    $created = $this->record->create([
                        "id" => $resultId,
                        "medical_record_id" => $request['medical_record_id'],
                        "description"=> $request['description'],
                        "complaint" => $request['complaint'],
                        "id_doctor" => $request['id_doctor'],
                        "id_schedules" => $request['id_schedules']
                    ]);
                    if ($created->exists()) {
                        $res['status'] = true;
                        $res['message'] = 'berhasil menambahkan detail rekam medic';
                        return $res;
                    }
                }else{
                    $res['status'] = false;
                    $res['message'] = 'gagal menambahkan data record , jadwal tidak ditemukan';
                    return $res;
                }
            }
        }
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
        $res = [];
        $check = $this->record->where('id', $id)->get();
        if ($check) {
            $this->record->where("id", $id)->delete();
            $res['status'] = true;
            $res['message'] = "berhasil menghapus detail rekam medic";
            return $res;
        } else {
            $res['status'] = false;
            $res['message'] = "gagal menghapus detail rekam medic , detail rekam medic tidak ditemukan";
            return $res;
        }
    }

    public function updateBukti($id , Request $request){     
        $file = $request->file('avatar');
       	        // nama file
		$fileName = $file->getClientOriginalName();
      	        // ekstensi file
		$fileExtension = $file->getClientOriginalExtension();

        $fullName = bcrypt($fileName.random_int(1000,9999)).".".$fileExtension;
      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'bukti_pembayaran';
        $res = $this->record->where('id' , $id)->update([
            "bukti" => $fullName
        ]);
        if($res){
            $file->move($tujuan_upload,$fullName);
            echo $res;
            return true;
        }else{
            echo $res;
            return false;
        }		
    }
}

?>