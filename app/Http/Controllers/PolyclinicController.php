<?php

namespace App\Http\Controllers;

use App\Http\Requests\PolyclinicRequest;
use App\Models\Polyclinic;
use App\Services\PolyclinicService;
use Illuminate\Http\Request;

class PolyclinicController extends Controller
{
    private PolyclinicService $service;

    public function __construct()
    {
        $this->service = new PolyclinicService();
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
    public function store(PolyclinicRequest $request)
    {
        $response = $this->service->store($request->validate($request->rules()));

        if ($response) {
            session()->flash("message", "berhasil menambah poliklinik");
        } else {
            session()->flash("message", "gagal menambah poliklinik");
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function show(Polyclinic $polyclinic)
    {
        $data = $this->service->findById($polyclinic->id);
        return $data;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Polyclinic $polyclinic)
    {
        $data = $this->service->findById($polyclinic->id);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function update(PolyclinicRequest $request, Polyclinic $polyclinic)
    {
        $response = $this->service->update($request->validate($request->rules()), $polyclinic);
        if ($response) {
            session()->flash("message", "berhasil memperbarui poliklinik");
        } else {
            session()->flash("message", "gagal memperbarui poliklinik");
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Polyclinic $polyclinic)
    {
        $response = $this->service->deleteById($polyclinic->id);
        if ($response) {
            session()->flash("message", "berhasil menghapus poliklinik");
        } else {
            session()->flash("message", "gagal menghapus poliklinik");
        }

        return $response;
    }

    public function searchByName(Request $request)
    {
        $data = $this->service->findByName($request);
        return $data;
    }
}
