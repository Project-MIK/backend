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

    public function __construct()
    {
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

    public function showById($id)
    {
        if (!isset(session("consultation")["polyclinic"])) return redirect("/konsultasi/poliklinik");

        $polyclinic_id = session('consultation')['polyclinic'][0];
        $doctors = $this->service->findByPolyclinic($polyclinic_id);

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

    public function showByIdAndDate($id, $date)
    {
        if (!isset(session("consultation")["polyclinic"])) return redirect("/konsultasi/poliklinik");

        $polyclinic_id = session('consultation')['polyclinic'][0];
        $doctors = $this->service->findByPolyclinic($polyclinic_id);

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

    public function create()
    {
        //
    }

    public function store(DoctorStoreRequest $request): bool
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
