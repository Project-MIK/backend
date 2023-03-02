<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleDetailStoreRequest;
use App\Http\Requests\ScheduleDetailUpdateRequest;
use App\Services\ScheduleDetailService;
use Illuminate\Http\Request;

class ScheduleDetailController extends Controller
{
    private ScheduleDetailService $service;

    public function __construct() {
        $this->service = new ScheduleDetailService();
    }
    
    public function index()
    {
        $data = $this->service->findAll();

        return $data;
    }

    public function create()
    {
        
    }

    public function store(ScheduleDetailStoreRequest $request)
    {
        $response = $this->service->add($request->validate($request->rules()));

        if ($response) {
            session()->flash("message", "berhasil menambah detail jadwal");
        } else {
            session()->flash("message", "gagal menambah detail jadwal");
        }

        return $response;
    }

    public function show($id)
    {
        $data = $this->service->findById($id);

        return $data;
    }

    public function edit($id)
    {
        
    }

    public function update(ScheduleDetailUpdateRequest $request, $id)
    {
        $response = $this->service->change($request->validate($request->rules()), $id);

        if ($response) {
            session()->flash("message", "berhasil memperbarui detail jadwal");
        } else {
            session()->flash("message", "gagal memperbarui detail jadwal");
        }

        return $response;
    }

    public function destroy($id)
    {
        $response = $this->service->delete($id);

        if ($response) {
            session()->flash("message", "berhasil menghapus detail jadwal");
        } else {
            session()->flash("message", "gagal menghapus detail jadwal");
        }

        return $response;
    }
}
