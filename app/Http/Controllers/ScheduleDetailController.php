<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleDetailStoreRequest;
use App\Http\Requests\ScheduleDetailUpdateRequest;
use App\Services\ScheduleDetailService;

class ScheduleDetailController extends Controller
{
    private ScheduleDetailService $service;

    public function __construct() {
        $this->service = new ScheduleDetailService();
    }
    
    public function index()
    {
        $schedules = $this->service->findAllSchedules();
        $doctors = $this->service->findAllDoctors();

        return view('admin.schedule', [
            'schedules' => $schedules,
            'doctors' => $doctors,
        ]);
    }

    public function create()
    {
        
    }

    public function store(ScheduleDetailStoreRequest $request)
    {
        $doctor = $request['doctor_id'];
        $validated = $request->validated();

        $response = $this->service->add($validated, $doctor);

        if ($response) {
            session()->flash("message", "berhasil menambah detail jadwal");
        } else {
            session()->flash("message", "gagal menambah detail jadwal");
        }

        return redirect('/admin/schedule');
    }

    public function show($id)
    {
        $data = $this->service->findById($id);

        return $data;
    }

    public function edit($id)
    {
        
    }

    public function update(ScheduleDetailUpdateRequest $request)
    {
        $id = $request->id;
        $doctor = $request['doctor_id'];
        $validated = $request->validated();
        $response = $this->service->change($validated, $doctor, $id);

        if ($response) {
            session()->flash("message", "berhasil memperbarui detail jadwal");
        } else {
            session()->flash("message", "gagal memperbarui detail jadwal");
        }

        return redirect('/admin/schedule');
    }

    public function destroy()
    {
        $id = request()->id;
        $response = $this->service->delete($id);

        if ($response) {
            session()->flash("message", "berhasil menghapus detail jadwal");
        } else {
            session()->flash("message", "gagal menghapus detail jadwal");
        }

        return redirect('/admin/schedule');
    }
}
