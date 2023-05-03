<?php

namespace App\Http\Controllers;

use App\Services\ConsultationService;
use App\Services\RecordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    private $service;
    private RecordService $recordService;
    
    public function __construct(ConsultationService $consultationService) 
    {
        $this->service = $consultationService;
        $this->recordService = new RecordService();
    }

    public function polyclinic()
    {
        if (!isset(session("consultation")["description"])) return redirect("/konsultasi");

        $category_id = session('consultation')['category'][0];
        $result = $this->service->findPolyclinicsByCategory($category_id);
        $polyclinics = [];

        foreach ($result as $key => $value) {
            $polyclinics[$value['id']] = $value['name'];
        }

        return view('pacient.consultation.polyclinic', compact('polyclinics'));
    }

    public function storePolyclinic(Request $request)
    {
        session(['consultation' => array_merge(session('consultation'), [
            "polyclinic" => explode("-", $request->input("consultation_polyclinic"))
        ])]);

        return redirect("/konsultasi/dokter");
    }

    public function doctor()
    {
        if (!isset(session("consultation")["polyclinic"])) return redirect("/konsultasi/poliklinik");

        $polyclinic_id = session('consultation')['polyclinic'][0];
        $doctors = $this->service->findDoctorsByPolyclinic($polyclinic_id);

        $schedules[] = $doctors[0]['schedules'];

        return view('pacient.consultation.doctor', [
            'doctors' => $doctors,
            'detail_doctor' => [
                'price_consultation' => "Rp. 90.000",
                'date_schedule' => $schedules,
                'time_schedule' => $schedules
            ]
        ]);
    }

    public function showDoctor(string $id)
    {
        if (!isset(session("consultation")["polyclinic"])) return redirect("/konsultasi/poliklinik");

        $polyclinic_id = session('consultation')['polyclinic'][0];
        $doctors = $this->service->findDoctorsByPolyclinic($polyclinic_id);
        $schedules = [];

        foreach ($doctors as $doctor) {
            if ($doctor['id'] == $id) {
                $schedules[] = $doctor['schedules'];
            }
        }


        return view('pacient.consultation.doctor', [
            'id' => $id,
            'doctors' => $doctors,
            'detail_doctor' => [
                'price_consultation' => "Rp. 90.000",
                'date_schedule' => $schedules,
                'time_schedule' => $schedules
            ]
        ]);
    }

    public function showDateDoctor(string $id, string $date)
    {
        if (!isset(session("consultation")["polyclinic"])) return redirect("/konsultasi/poliklinik");

        $polyclinic_id = session('consultation')['polyclinic'][0];
        $doctors = $this->service->findDoctorsByPolyclinic($polyclinic_id);

        foreach ($doctors as $doctor) {
            if ($doctor['id'] == $id) {
                $schedules[] = $doctor['schedules'];
            }
        }

        foreach ($schedules[0] as $schedule) {
            if (date('d-M-Y', strtotime($schedule['consultation_date'])) == $date) {
                $times[0][] = $schedule;
            }
        }

        return view('pacient.consultation.doctor', [
            'id' => $id,
            'date' => $date,
            'doctors' => $doctors,
            'detail_doctor' => [
                'price_consultation' => "Rp. 90.000",
                'date_schedule' => $schedules,
                'time_schedule' => $times
            ]
        ]);
    }

    public function storeDoctor(Request $request)
    {
        session(['consultation' => array_merge(session('consultation'), [
            "doctor" => explode("-", $request->input("consultation_doctor")),
            "price" => $request->input("consultation_price"),
            "schedule_date" => $request->input("consultation_schedule_date"),
            "schedule_time" => explode("-", $request->input("consultation_schedule_time"))
        ])]);

        return redirect("/konsultasi/rincian");
    }

    public function consultation()
    {
        if (!isset(session("consultation")["doctor"])) return redirect("/konsultasi/dokter");
        
        return view("pacient.consultation.detail-order");
    }

    public function storeConsultation(Request $request)
    {
        $date = session('consultation')['schedule_date'];
        $schedule = $this->service->findScheduleByDate($date);

        session(['consultation' => array_merge(session('consultation'), [
            "schedule" => $schedule->id
        ])]);

        $validator = Validator::make($request->all(), [
            'description' => ['required', 'max:255', 'min:10'],
            [
                'description.required' => 'Deskripsi keluhan tidak boleh kosong',
                "description.max" => "Deskripsi Keluhan tidak boleh lebih dari 255 huruf",
                'description.min' => "Deskripsi Keluhan tidak boleh kurang dari 10"
            ]
        ]);
        if ($validator->fails()) {
            return redirect('/konsultasi')->withErrors($validator);
        }
        if (Auth::guard('pattient')->check()) {
            $idMedicalRecord = Auth::guard('pattient')->user()->medical_record_id;
            $requestParam = session('consultation');
            $data = [
                "medical_record_id" => $idMedicalRecord,
                "description" => $requestParam['description'],
                "complaint" => $requestParam['description'],
                "id_schedules" => $requestParam['schedule'],
                "id_doctor" => $requestParam['doctor'][0],
                "id_category" => $requestParam['category']
            ];
            $res = $this->recordService->insert($data);
            if ($res['status']) {
                $id = $res['id'];
                return redirect("/konsultasi/$id#payment");
            } else {
                return redirect('dasboard')->with('message', 'gagal membuat konsultasi terjadi kesalahan');
            }
        } else {
            return redirect("/masuk")->with("message", "silahkan login terlebih dahulu");
        }


        dd(session('consultation'));
    }
}
