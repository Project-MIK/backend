<?php

namespace App\Http\Controllers;

use App\Services\ConsultationService;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    private $service;
    
    public function __construct(ConsultationService $consultationService) 
    {
        $this->service = $consultationService;
    }

    public function polyclinic()
    {
        if (!isset(session("consultation")["description"])) return redirect("/konsultasi");

        $category_id = session('consultation')['category'][0];
        $result = $this->service->findPolyclinicsByCategory($category_id);

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
        return redirect("/konsultasi/KL6584690#payment");
    }
}
