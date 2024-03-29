<?php


namespace App\Services;

use App\Helpers\Helper;
use App\Models\Doctor;
use App\Models\MedicalRecords;
use App\Models\Pattient;
use App\Models\Recipes;
use App\Models\Record;
use App\Models\RecordCategory;
use App\Models\ScheduleDetail;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecordService
{

    private Record $record;
    private MedicalRecords $medicalRecord;
    private Doctor $doctor;
    private RecordCategory $recordCategory;

    private ScheduleDetail $schedule;
    private Pattient $pattient;
    private Recipes $recipe;

    private ScheduleDetailService $scheduleDetailService;


    public function __construct()
    {
        $this->record = new Record();
        $this->medicalRecord = new MedicalRecords();
        $this->doctor = new Doctor();
        $this->schedule = new ScheduleDetail();
        $this->recordCategory = new RecordCategory();
        $this->pattient = new Pattient();
        $this->recipe = new Recipes();
        $this->scheduleDetailService = new ScheduleDetailService();
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
            $randomString = random_int(1000000, 9999999);
            $resultId = $prefix . $randomString;
            $uniqueid = $this->record->where('id', $resultId)->first();
        } while ($uniqueid != null);
        $scheduleTime = $this->schedule->where('id', $request['id_schedules'])->first();
        $oneHourAgo = Carbon::parse($scheduleTime->time_start)->subHour();
        $oneHourAgoFormated = $oneHourAgo->format('H:i:s');
        $validStatus = new \DateTime(Carbon::parse($scheduleTime->consultation_date. " " .$oneHourAgoFormated));
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
                if ($existSchedule != null) {
                    if ($existSchedule->status != "kosong") {
                        $res['status'] = false;
                        $res['message'] = 'gagal menambahkan record , jadwal yang anda pilih tidak sedang kosong';
                        return $res;
                    }
                    $request['id'] = $resultId;
                    $created = $this->record->create([
                        "id" => $resultId,
                        "medical_record_id" => $request['medical_record_id'],
                        "description" => $request['description'],
                        "complaint" => $request['complaint'],
                        "doctor_id" => $request['id_doctor'],
                        "schedule_id" => $request['id_schedules'],
                        "id_category" => $request['id_category'][0],
                        "valid_status" => $validStatus
                    ]);
                    if ($created->exists()) {
                        $res['status'] = true;
                        $res['message'] = 'berhasil menambahkan detail rekam medic';
                        $res['id'] = $resultId;
                        return $res;
                    }
                } else {
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

    public function updateBukti($id, Request $request)
    {
        $payment = $request->only('bank-payment');

        $file = $request->file('upload-proof-payment');
        // nama file
        $fileName = $file->getClientOriginalName();
        // ekstensi file
        $fileExtension = $file->getClientOriginalExtension();

        $fullName = md5($fileName . random_int(1000, 9999)) . "." . $fileExtension;
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'bukti_pembayaran';

        $res = Db::table('record')->where('id', $id)->update(
            [
                "bukti" => $fullName,
                'status_payment_consultation' => 'PROSES VERIFIKASI',
                'status_consultation' => "waiting-consultation-payment",
                'payment_method' => $payment['bank-payment']
            ]
        );
        if ($res) {
            $file->move($tujuan_upload, $fullName);
            return true;
        } else {
            return false;
        }
    }

    public function validBuktiPembayaran($id)
    {
        $res = $this->record->where('id', $id)->update([
            "status" => "confirmed-consultation-payment"
        ]);
        if ($res) {
            return true;
        }
        return false;
    }


    public function cancelConsultation($id)
    {
        $res = $this->record->where('id', $id)->update([
            "status_payment_consultation" => "DIBATALKAN",
            'status_consultation' => 'consultation-complete'
        ]);
        $dataRecord = $this->record->where('id' , $id)->first();
        $this->scheduleDetailService->updateStatus($dataRecord->schedule_id, "kosong");
        if ($res) {
            return true;
        }
        return false;
    }

    public function showComplaintOnAdmin()
    {
        $res = $this->pattient
            ->join('medical_records', 'medical_records.medical_record_id', 'pattient.medical_record_id')
            ->join('record', 'record.medical_record_id', 'medical_records.medical_record_id')
            ->join('record_category', 'record.id_category', 'record_category.id')
            ->join('doctors', 'record.doctor_id', 'doctors.id')
            ->join('polyclinics', 'polyclinics.id', 'doctors.polyclinic_id')
            ->join('payment_metode', 'payment_metode.id', 'record.payment_method')
            ->select('record.id as id_record', 'pattient.name as name', 'pattient.medical_record_id as no rekammedic', 'record_category.category_name as category', 'polyclinics.name as poly', 'doctors.name as doctor', 'record.bukti as link_foto', 'record.description', 'record.status_payment_consultation as status', 'payment_metode.name as payment_method')
            ->get()->toArray();
        foreach ($res as $key => $value) {
            # code...
            $res[$key]['payment_amount'] = '90.000';
            $res[$key]['link_foto'] = url('/') . ('/bukti_pembayaran/' . $res[$key]['link_foto']);
            $res[$key]['id'] = $res[$key]['id_record'];
            $status = $res[$key]['status'];
            $resultStatus = 0;
            if ($status == 'PROSES VERIFIKASI') {
                $resultStatus = 0;
            } else if ($status == 'PEMBAYARAN TIDAK VALID') {
                $resultStatus = 1;
            } else if ($status == 'TERKONFIRMASI') {
                $resultStatus = 2;
            }
            $res[$key]['status'] = $resultStatus;
            unset($res[$key]['id_record']);
        }
        return $res;
    }

    public function acceptPaymentOrDecline($id, $status)
    {
        $res = [];
        if ($status == 'disetujui') {
            $isUpdate = $this->record->where('id', $id)
                ->update([
                    'status_consultation' => 'confirmed-consultation-payment',
                    'status_payment_consultation' => 'TERKONFIRMASI'
                ]);

            if ($isUpdate) {
                $res['status'] = true;
                $res['message'] = 'berhasil menyetujui pembayaran';
                return $res;
            } else {
                $res['status'] = false;
                $res['message'] = 'gagal menyetujui pembayaran';
                return $res;
            }
        } else {
            $isUpdate = $this->record->where('id', $id)
                ->update([
                    'status_payment_consultation' => 'PEMBAYARAN TIDAK VALID'
                ]);
            if ($isUpdate) {
                $res['status'] = true;
                $res['message'] = 'berhasil menolak pembayaran';
                return $res;
            } else {
                $res['status'] = true;
                $res['message'] = 'berhasil menolak pembayaran';
                return $res;
            }
        }

    }


    public function showConsulByDocter($id)
    {
        $data = $this->pattient
            ->join('medical_records', 'medical_records.medical_record_id', 'pattient.medical_record_id')
            ->join('record', 'record.medical_record_id', 'medical_records.medical_record_id')
            ->join('doctors', 'doctors.id', 'record.doctor_id')
            ->join('schedule_details', 'schedule_details.id', 'record.schedule_id')
            ->select('record.id as consul_id', 'pattient.name as patient_name', 'pattient.medical_record_id as medrec', 'schedule_details.time_start as start', 'schedule_details.time_end as end' , 'schedule_details.consultation_date')
            ->where('doctors.id', $id)
            ->where('record.status_consultation' , 'confirmed-consultation-payment')
            ->get()->toArray();
        foreach ($data as $key => $value) {
            # code...
        
            $timeStart = Carbon::parse($data[$key]['consultation_date']." ".$data[$key]['start']);
            $timeEnd = Carbon::parse($data[$key]['consultation_date']." ".$data[$key]['end']);
            $data[$key]['start'] = strtotime($timeStart);
            $data[$key]['end'] = strtotime($timeEnd);
            $duration = $data[$key]['end'] - $data[$key]['start'];
            $data[$key]['duration'] = $duration;
            $data[$key]['link'] = "https://meet.jit.si/" . $data[$key]['consul_id'];
        }
        return $data;

    }

    public function consultationComplete($idRecord)
    {
        $res = $this->record->where('id', $idRecord)->update(
            ['status_consultation' => 'consultation-complete']
        );
        if ($res) {
            return true;
        }
        return false;
    }


    public function startConverenceAdminById($id)
    {
        $res = $this->pattient
            ->join('medical_records', 'medical_records.medical_record_id', 'pattient.medical_record_id')
            ->join('record', 'record.medical_record_id', 'medical_records.medical_record_id')
            ->join('doctors', 'doctors.id', 'record.doctor_id')
            ->join('schedule_details', 'record.schedule_id', 'schedule_details.id')
            ->select('pattient.name as patien', 'record.id as id_consul', 'doctors.name as doctor', 'schedule_details.time_start', 'schedule_details.time_end' , 'schedule_details.id as id_schedule')
            ->where('record.status_consultation', 'confirmed-consultation-payment')
            ->where('record.status_payment_consultation', 'TERKONFIRMASI')
            ->where('record.id', $id)
            ->first();
        

        $isUpdate = $this->scheduleDetailService->updateStatus($res['id_schedule'] , 'kosong');
        if ($res != null) {
            $res = $res->toArray();
            $start = now();
            $end = Carbon::parse($res['time_end']);
            $duration = $start->diffInMilliseconds($end);
            $start = strtotime($res['time_start']);
            $end = strtotime($res['time_end']);
            $res['duration'] = $duration;
            $res['time_start'] = strtotime($res['time_start']);
            $res['time_end'] = strtotime($res['time_end']);
        }
        # code...

        return $res;
    }


    public function showConsulAdmin()
    {
        $currentDate = Carbon::now();
        $res = $this->pattient
            ->join('medical_records', 'medical_records.medical_record_id', 'pattient.medical_record_id')
            ->join('record', 'record.medical_record_id', 'medical_records.medical_record_id')
            ->join('doctors', 'doctors.id', 'record.doctor_id')
            ->join('schedule_details', 'record.schedule_id', 'schedule_details.id')
            ->select('record.id as consul_id', 'pattient.name as patient_name', 'pattient.medical_record_id as medrec', 'doctors.name as doctor', 'schedule_details.time_start as start', 'schedule_details.time_end as end', 'record.valid_status' , 'schedule_details.id as id_schedule','schedule_details.consultation_date')
            ->where('record.status_consultation', 'confirmed-consultation-payment')
            ->where('record.status_payment_consultation', 'TERKONFIRMASI')
            ->get()->toArray();
        foreach ($res as $key => $value) {
            # code...
            $timeStart = Carbon::parse($res[$key]['consultation_date']." ".$res[$key]['start']);
            $timeEnd = Carbon::parse($res[$key]['consultation_date']." ".$res[$key]['end']);
            $res[$key]['start'] = strtotime($timeStart);
            $res[$key]['end'] = strtotime($timeEnd);
            $duration = $res[$key]['end'] - $res[$key]['start'];
            $res[$key]['duration'] = $duration;
        }
        return $res;
    }

    public function addRecipe($id, array $request)
    {

    }

    public function update_to_consultation_waiting($idRecord)
    {
        $this->record->where('id', $idRecord)->update([
            'status_consultation' => 'waiting-consultation-payment'
        ]);
    }

    public function update_to_consultation_complete($idrecord)
    {
        $this->record->where('id' , $idrecord)->update([
            "status_consultation" => "consultation-complete"
        ]);
    }
    public function update_to_confirmed_consultation_payment($idRecord)
    {

    }
    public function update_to_consultation_payment_waiting($idRecord)
    {
        // waiting-medical-prescription-payment
        $data = $this->record->where('id', $idRecord)->first();
        if ($data != null) {
            $this->record->where('id', $idRecord)->update([
                'status_consultation' => 'waiting-medical-prescription-payment',
                "valid_status" => Carbon::parse($data->valid_status)->addHours(2)->toDateTimeString()
            ]);
        }
    }
    public function setMetodeDelivery(array $request)
    {
        $data = $this->record->where('id', $request['id'])->first();
        if ($data != null) {
            $this->record->where('id', $request['id'])->update([
                'status_consultation' => 'consultation-complete'
            ]);
            $idRecipe = $data->id_recipe;
            $metode = $request['pickup-medical-prescription'];
            if ($metode == 'delivery-gojek') {
                $isUpdate = $this->recipe->where('id', $idRecipe)->update(
                    [
                        'no_telp_delivery' => $request['pacient-notelp'],
                        'pickup_medical_addreass_pacient' => $request['pacient-addreass'],
                        'pickup_medical_prescription' => 'delivery-gojek',
                        'pickup_medical_status' => 'DIKIRIM DENGAN GOJEK'
                    ]
                );
                if ($isUpdate) {
                    return true;
                }
                return false;
            } else if ($metode == ['hospital-pharmacy']) {
                $isUpdate = $this->recipe->where('id', $idRecipe)->update([
                    'pickup_medical_prescription' => 'hospital-pharmacy'
                ]);
                if ($isUpdate) {
                    return true;
                }
                return false;
            }
        } else {
            return false;
        }

    }


    public function cetakDokumentPengambilanObat($idRecord)
    {
        $data = $this->pattient
            ->join('medical_records', 'medical_records.medical_record_id', 'pattient.medical_record_id')
            ->join('record', 'medical_records.medical_record_id', 'record.medical_record_id')
            ->join('doctors', 'record.doctor_id', 'doctors.id')
            ->join('recipes', 'record.id_recipe', 'recipes.id')
            ->join('recipe_detail', 'recipe_detail.id_recipe', 'recipe_detail.id')
            ->select('pattient.name as fullname', 'pattient.medical_record_id as no_medical_record', 'record.id as id_consultation', 'record.valid_status', 'doctors.name as doctor', 'record.status_payment_consultation as status', 'recipes.price_medical_prescription as price', 'recipes.status_payment_medical_prescription')
            ->where('record.id', $idRecord)
            ->groupBy('record.id')
            ->get()->toArray();
        $consultation = [
            'doctor' => $data[0]['doctor'],
            'price' => "90.000",
            'status' => $data[0]['status']
        ];
        $medical = [
            'price' => $data[0]['price'],
            'status' => $data[0]['status_payment_medical_prescription']
        ];
        foreach ($data as $key => $value) {
            # code...
            unset($data[$key]['doctor'], $data[$key]['price'], $data[$key]['status'], $data[$key]['status_payment_medical_prescription']);
            $data[$key]['valid_status'] = strtotime($data[$key]['valid_status']);
        }
        $newData = $data;
        $newData[0]['consultation'] = $consultation;
        $newData[0]['medical'] = $medical;
        return $newData;
    }

    public function getJitsiViewDoctor($id)
    {
        $data = $this->pattient
            ->join('medical_records', 'medical_records.medical_record_id', 'pattient.medical_record_id')
            ->join('record', 'medical_records.medical_record_id', 'record.medical_record_id')
            ->join('doctors', 'doctors.id', 'record.doctor_id')
            ->join('schedule_details', 'schedule_details.id', 'record.schedule_id')
            ->where('record.id', $id)
            ->where('record.status_consultation', 'confirmed-consultation-payment')
            ->select('pattient.name as patien', 'doctors.name as doctor', 'schedule_details.time_start', 'schedule_details.time_end')
            ->get()->toArray();
        $res = [];
        if (count($data) > 0) {
            $res['patien'] = $data[0]['patien'];
            $res['doctor'] = $data[0]['doctor'];
            $res['duration'] = strtotime($data[0]['time_end']) - strtotime($data[0]['time_start']);
            $start = now();
            $end = Carbon::parse($data[0]['time_end']);
            $duration = $start->diffInMilliseconds($end);
            $start = strtotime($data[0]['time_start']);
            $end = strtotime($data[0]['time_end']);
            $res['duration'] = $duration;
            $res['time_start'] = strtotime($data[0]['time_start']);
            $res['time_end'] = strtotime($data[0]['time_end']);
        }
        return $res;

    }

    public function cancelMedicalPrescription($id){
        $record = $this->record->where('id' , $id)->first();
        $recipe = $record->id_recipe;
        $this->record->where('id', $id)->update(
            [
                'id_recipe' => null,
                "status_consultation" => 'consultation-complete'
            ]
        );
        Recipes::destroy($recipe);
    }
    
}

?>