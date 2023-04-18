<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Models\Doctor;
use App\Services\DoctorService;
use App\Services\ScheduleService;

class DoctorController extends Controller
{
    private DoctorService $service;

    public function __construct() {
        $this->service = new DoctorService();
    }

    public function index()
    {
        
    }

    public function showByPolyclinic()
    {
        if (!isset(session("consultation")["polyclinic"])) return redirect("/konsultasi/poliklinik");

        $id = session('consultation')['polyclinic'][0];
        $doctors = $this->service->findByPolyclinic($id);
        $schedule = null;
        $scheduleDetails = null;
        $scheduleService = new ScheduleService();

        if ($doctors !== null) {
            $doctor_id = $doctors[0]['id'];
            $schedule = $scheduleService->findByDoctor($doctor_id);
            $scheduleDetails = null;
        }

        if ($schedule !== null) {
            $scheduleDetails = $schedule[0]['schedule_details'];
        }


        return view('pacient.consultation.doctor', [
            'doctors' => $doctors,
            'detail_doctor' => [
                'price_consultation' => "Rp. 90.000",
                'date_schedule' => $scheduleDetails,
                'time_schedule' => $scheduleDetails
            ]
        ]);
    }

    public function showById($id)
    {
        if (!isset(session("consultation")["polyclinic"])) return redirect("/konsultasi/poliklinik");
        
        $polyclinic_id = session('consultation')['polyclinic'][0];
        $doctors = $this->service->findByPolyclinic($polyclinic_id);
        $scheduleService = new ScheduleService();
        $schedule = $scheduleService->findByDoctor($id);
        $scheduleDetails = null;

        if ($schedule !== null) {
            $scheduleDetails = $schedule[0]['schedule_details'];
        }

        return view('pacient.consultation.doctor', [
            'id' => $id,
            'doctors' => $doctors,
            'detail_doctor' => [
                'price_consultation' => "Rp. 90.000",
                'date_schedule' => $scheduleDetails,
                'time_schedule' => $scheduleDetails
            ]
        ]);
    }

    public function showByIdAndDate($id, $date)
    {
        if (!isset(session("consultation")["polyclinic"])) return redirect("/konsultasi/poliklinik");

        $polyclinic_id = session('consultation')['polyclinic'][0];
        $doctors = $this->service->findByPolyclinic($polyclinic_id);
        // dd($date);
        $scheduleService = new ScheduleService();
        $schedule = $scheduleService->findByDoctor($id);
        $scheduleDetails = null;
        $scheduleTime = (array) $scheduleService->findByDoctorAndDate($id, $date);
        // dd($scheduleTime);
        // dd(gettype($scheduleTime));
        

        if ($schedule !== null) {
            $scheduleDetails = $schedule[0]['schedule_details'];
        }

        // dd($id, $date);

        return view('pacient.consultation.doctor', [
            'id' => $id,
            'date' => $date,
            'doctors' => $doctors,
            'detail_doctor' => [
                'price_consultation' => "Rp. 90.000",
                'date_schedule' => $scheduleDetails,
                'time_schedule' => $scheduleTime
            ]
        ]);
    }

    public function create()
    {
        //
    }

    public function store(DoctorStoreRequest $request) : bool
    {
        $response = $this->service->add($request->validate($request->rules()));

        if ($response) {
            session()->flash("message", "berhasil menambah dokter");
        } else {
            session()->flash("message", "gagal menambah dokter");
        }

        return $response;
    }

    public function show($id)
    {
        $data = $this->service->findById($id);

        return view('doctor.pages.schedule', [
            'data' => $data
        ]);
    }

    public function edit(Doctor $doctor)
    {
        //
    }

    public function update(DoctorUpdateRequest $request, $id)
    {
        $response = $this->service->change($request->validate($request->rules()), $id);
        if ($response) {
            session()->flash("message", "berhasil memperbarui dokter");
        } else {
            session()->flash("message", "gagal memperbarui dokter");
        }
        return $response;
    }

    public function destroy($id)
    {
        $response = $this->service->deleteById($id);
        if ($response) {
            session()->flash("message", "berhasil menghapus dokter");
        } else {
            session()->flash("message", "gagal menghapus dokter");
        }

        return $response;
    }

    public function searchByName(string $search)
    {
        $data = $this->service->findByName($search);
        return $data;
    }

    public function searchByGender(string $gender)
    {
        $data = $this->service->findByGender($gender);
        return $data;
    }
}
