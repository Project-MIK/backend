<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleStoreRequest;
use App\Http\Requests\ScheduleUpdateRequest;
use App\Services\ScheduleService;

class ScheduleController extends Controller
{
    private ScheduleService $service;

    public function __construct() {
        $this->service = new ScheduleService();
    }

    public function index() {
        $data = $this->service->findAll();

        return $data;
    }

    public function create() {

    }

    public function store(ScheduleStoreRequest $request) {
        $response = $this->service->add($request->validate($request->rules()));

        if ($response) {
            session()->flash("message", "berhasil menambah jadwal");
        } else {
            session()->flash("message", "gagal menambah jadwal");
        }

        return $response;
    }

    public function show($id) {
        $data = $this->service->findById($id);

        return $data;
    }

    public function edit($id) {

    }

    public function update(ScheduleUpdateRequest $request, $id) {
        $response = $this->service->change($request->validate($request->rules()), $id);

        if ($response) {
            session()->flash("message", "berhasil memperbarui jadwal");
        } else {
            session()->flash("message", "gagal memperbarui jadwal");
        }

        return $response;
    }

    public function destroy($id) {
        $response = $this->service->delete($id);

        if ($response) {
            session()->flash("message", "berhasil menghapus jadwal");
        } else {
            session()->flash("message", "gagal menghapus jadwal");
        }

        return $response;
    }
}