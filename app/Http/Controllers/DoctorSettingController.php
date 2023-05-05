<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorUpdateRequest;
use App\Services\DoctorService;
use Illuminate\Http\Request;

class DoctorSettingController extends Controller
{
    private $service;

    public function __construct(DoctorService $doctorService)
    {
        $this->service = $doctorService;
    }

    public function index()
    {
        $id = auth('doctor')->id();
        $doctor = $this->service->findById($id);

        return view('doctor.pages.setting', compact('doctor'));
    }

    public function update(DoctorUpdateRequest $request)
    {
        $id = auth('doctor')->id();
        $validated = $request->validated();
        $response = $this->service->changeSetting($validated, $id);

        if ($response) {
            session()->flash("message", "berhasil memperbarui dokter");
        } else {
            session()->flash("message", "gagal memperbarui dokter");
        }

        return redirect('/doctor/setting');
    }

    public function email(DoctorUpdateRequest $request)
    {
        $id = auth('doctor')->id();
        $validated = $request->validated();
        $response = $this->service->changeEmail($validated, $id);

        if ($response) {
            session()->flash("message", "berhasil memperbarui dokter");
        } else {
            session()->flash("message", "gagal memperbarui dokter");
        }
        
        return redirect('/doctor/setting');
    }

    public function password(Request $request)
    {
        $id = auth('doctor')->id();
        $validated = $request->validate([
            'password' => 'required|confirmed',
        ]);
        $response = $this->service->changePassword($validated, $id);

        if ($response) {
            session()->flash("message", "berhasil memperbarui dokter");
        } else {
            session()->flash("message", "gagal memperbarui dokter");
        }

        return redirect('/doctor/setting');
    }
}
