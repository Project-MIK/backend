<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use App\Services\DoctorService;

class DoctorController extends Controller
{
    private DoctorService $service;

    public function __construct() {
        $this->service = new DoctorService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->service->findAll();

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorRequest $request) : bool
    {
        $response = $this->service->add($request->validate($request->rules()));

        if ($response) {
            session()->flash("message", "berhasil menambah dokter");
        } else {
            session()->flash("message", "gagal menambah dokter");
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->service->findById($id);

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request, $id)
    {
        $response = $this->service->change($request->validate($request->rules()), $id);
        if ($response) {
            session()->flash("message", "berhasil memperbarui dokter");
        } else {
            session()->flash("message", "gagal memperbarui dokter");
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
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
