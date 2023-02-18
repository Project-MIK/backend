<?php

namespace App\Http\Controllers;

use App\Http\Requests\PolyclinicRequest;
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
    public function store(PolyclinicRequest $request) : bool
    {
        $response = $this->service->add($request->validate($request->rules()));

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
    public function show($id){

        $data = $this->service->findById($id);
        return $data;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->service->findById($id);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Polyclinic  $polyclinic
     * @return \Illuminate\Http\Response
     */
    public function update(PolyclinicRequest $request, $id)
    {
        $response = $this->service->change($request->validate($request->rules()), $id);
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
    public function destroy($id)
    {
        $response = $this->service->deleteById($id);
        if ($response) {
            session()->flash("message", "berhasil menghapus poliklinik");
        } else {
            session()->flash("message", "gagal menghapus poliklinik");
        }

        return $response;
    }

    public function searchByName(string $search)
    {
        $data = $this->service->findByName($search);
        return $data;
    }
}
