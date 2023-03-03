<?php

namespace App\Http\Controllers;

use App\Http\Requests\PolyclinicStoreRequest;
use App\Http\Requests\PolyclinicUpdateRequest;
use App\Services\PolyclinicService;

class PolyclinicController extends Controller
{
    private PolyclinicService $service;

    public function __construct()
    {
        $this->service = new PolyclinicService();
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

    public function store(PolyclinicStoreRequest $request) : bool
    {
        $response = $this->service->add($request->validate($request->rules()));

        if ($response) {
            session()->flash("message", "berhasil menambah poliklinik");
        } else {
            session()->flash("message", "gagal menambah poliklinik");
        }

        return $response;
    }

    public function show($id){

        $data = $this->service->findById($id);
        return $data;
    }

    public function edit($id)
    {
        $data = $this->service->findById($id);
        return $data;
    }

    public function update(PolyclinicUpdateRequest $request, $id)
    {
        $response = $this->service->change($request->validate($request->rules()), $id);
        if ($response) {
            session()->flash("message", "berhasil memperbarui poliklinik");
        } else {
            session()->flash("message", "gagal memperbarui poliklinik");
        }
        return $response;
    }

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
