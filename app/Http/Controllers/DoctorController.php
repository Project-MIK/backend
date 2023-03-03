<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Models\Doctor;
use App\Services\DoctorService;

class DoctorController extends Controller
{
    private DoctorService $service;

    public function __construct() {
        $this->service = new DoctorService();
    }

    public function index()
    {
        $data = $this->service->findAll();

        return $data;
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

        return $data;
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
