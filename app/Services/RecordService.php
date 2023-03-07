<?php


namespace App\Services;

use App\Helpers\Helper;
use App\Models\Doctor;
use App\Models\MedicalRecords;
use App\Models\Pattient;
use App\Models\Record;
use App\Models\RecordCategory;
use App\Models\ScheduleDetail;
use Carbon\Carbon;
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


    public function __construct()
    {
        $this->record = new Record();
        $this->medicalRecord = new MedicalRecords();
        $this->doctor = new Doctor();
        $this->schedule = new ScheduleDetail();
        $this->recordCategory = new RecordCategory();
        $this->pattient = new Pattient();
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
        $validStatus = new \DateTime(Carbon::parse($scheduleTime->time_start));
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
                        "schedule_id" => 1,
                        "id_category" => $request['id_category'],
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
        if ($res) {
            return true;
        }
        return false;
    }

    public function showComplaintOnAdmin()
    {
        // 'id'=>'KLaasdj',
        //             'name'=>'Bachtiar Arya Habibie',
        //             'category'=>'kepala',
        //             'poly'=>'anak',
        //             'doctor'=>'anis',
        //             'link_foto'=>'https://blue.kumparan.com/image/upload/fl_progressive,fl_lossy,c_fill,q_auto:best,w_640/v1600959891/inewyddubc2v9au1ef2h.png',
        //             'description'=>'Saya, John, mengalami sakit kepala yang cukup mengganggu belakangan ini. Sakit kepala ini terjadi pada bagian belakang kepala dan terjadi sekitar 2-3 kali seminggu. Setiap kali sakit kepala terjadi, saya merasakan mual dan sedikit pusing yang cukup mengganggu aktivitas saya. Sakit kepala ini berlangsung selama sekitar 2-3 jam setiap kali terjadi. Meskipun saya tidak memiliki riwayat penyakit kepala atau keluarga yang menderita sakit kepala secara serius, namun saya menyadari bahwa kebiasaan saya yang sering bekerja dengan komputer dalam waktu yang lama dan kurang istirahat mungkin menjadi faktor pemicu sakit kepala yang saya alami. Saya berharap dapat menemukan solusi yang tepat untuk mengatasi keluhan sakit kepala yang saya alami ini.',
        //             'payment_method'=>'BRI',
        //             'payment_amount'=>90000,
        //             'status'=>'belum terkonfirmasi'
        $res = $this->pattient
            ->join('medical_records', 'medical_records.medical_record_id', 'pattient.medical_record_id')
            ->join('record', 'record.medical_record_id', 'medical_records.medical_record_id')
            ->join('record_category', 'record.id_category', 'record_category.id')
            ->join('doctors', 'record.doctor_id', 'doctors.id')
            ->join('polyclinics', 'polyclinics.id', 'doctors.polyclinic_id')
            ->join('payment_metode', 'payment_metode.id', 'record.payment_method')
            ->select('record.id as id_record', 'pattient.name as name', 'pattient.medical_record_id as no rekammedic', 'record_category.category_name as category', 'polyclinics.name as poly', 'doctors.name as doctor', 'record.bukti as link_foto', 'record.description', 'record.status_consultation as status', 'payment_metode.name as payment_method')
            ->get()->toArray();
        foreach ($res as $key => $value) {
            # code...
            $res[$key]['payment_amount'] = '90.000';
            $res[$key]['link_foto'] = url('/') . ('/bukti_pembayaran/' . $res[$key]['link_foto']);
            $res[$key]['id'] = $res[$key]['id_record'];
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
                    'status_consultation' => 'confirmerd_consultation_payment',
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
            ->select('record.id as consul_id', 'pattient.name as patient_name', 'pattient.medical_record_id as medrec', 'schedule_details.time_start as start', 'schedule_details.time_end as end')
            ->where('doctors.id', $id)
            ->get()->toArray();
        foreach ($data as $key => $value) {
            # code...
            $start = strtotime($data[$key]['start']);
            $end = strtotime($data[$key]['end']);
            unset($data[$key]['start'], $data[$key]['end']);
            $data[$key]['duration'] = $end - $start;
            $data[$key]['start'] = $start;
            $data[$key]['end'] = $end;
            $data[$key]['link'] = "https://meet.jit.si/" . $data[$key]['consul_id'];
        }
        return $data;

    }

}

?>