<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationOfficersRequest;
use App\Models\RegistrationOfficers;
use App\Services\RegistrationOfficerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class RegistrationOfficersController extends Controller
{

    private RegistrationOfficerService $service;

    public function __construct()
    {
        $this->service = new RegistrationOfficerService();
    }

    public function index()
    {
        $data = $this->service->findAll();
        return $data;
    }
    public function create()
    {
        // return view to create new registration officers
    }
    public function store(RegistrationOfficersRequest $request)
    {
        $res = $this->service->store($request->validate($request->rules()));
        if ($res != null) {
            session()->flash('message', "berhasil menambahkan data pegawai");
        } else {
            session()->flash('message', "gagal menambahkan data pegawai");
        }
    }
    public function show($id)
    {
        $data = $this->service->findById($id);
        if($data!=null){
            return $data;
        }
        return response($data, 404)
            ->header('Content-Type', 'text/plain');
    }
    public function edit()
    {
        // edit view
    }
    public function update(RegistrationOfficersRequest $request, $id)
    {
        // use key in array on frontend to send your value
        $res = $this->service->update($request->validate($request->rules()), $id);
        if ($res) {
            session()->flash("message", "berhasil memperbarui data pegawai pendaftaran");
        } else {
            session()->flash("message", "gagal memperbarui data pegawai pendaftaran");
        }
        // return view
    }

    public function destroy($id)
    {
        $res = $this->service->deleteById($id);
        if ($res) {
            session()->flash("message", "berhasil menghapus data");
        } else {
            session()->flash("message", "gagal menghapus data , data tidak ditemukan");
        }
        // return view
    }
}
