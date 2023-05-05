<?php

namespace App\Http\Controllers;

use App\Services\DoctorService;

class DoctorScheduleController extends Controller
{
    private $service;

    public function __construct(DoctorService $doctorService)
    {
        $this->service = $doctorService;
    }

    public function index()
    {
        $id = auth('doctor')->id();
        $doctor = $this->service->findAllDoctorSchedules($id);

        return view('doctor.pages.schedule', [
            'schedules' => $doctor->schedules
        ]);
    }
}
