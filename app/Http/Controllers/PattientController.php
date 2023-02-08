<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePattientRequest;
use App\Http\Requests\UpdatePattientRequest;
use App\Models\Pattient;
use App\Services\PattientService;

class PattientController extends Controller
{

    private PattientService $service;


    public function __construct()
    {
        $this->service = new PattientService();
    }

    public function index()
    {
        $data = $this->service->findAll();
        if ($data->count() > 0) {
            // ada data
            return $data;
        }
        return $data;
        // no data
    }

    public function create()
    {
        // return view create new pattient
    }
    public function store(StorePattientRequest $request)
    {
        // bool return
        $res =  $this->service->store($request->validate($request->rules()));
    }

    public function show(Pattient $pattient)
    {
        $data = $this->service->findById($pattient->id);
        return $data;
    }

    public function edit(Pattient $pattient)
    {
        $data = $this->service->findById($pattient);
        // return view to edit , with data variable 
    }

    public function update(UpdatePattientRequest $request, Pattient $pattient)
    {
        // response array , you can see in service class to documentation
        $res =  $this->service->update($request->validate($request->rules()), $pattient->id);
    }

    public function destroy(Pattient $pattient)
    {
        // res boolean true if success false if not found
        $res = $this->service->deleteById($pattient->id);
    }
}
