<?php

namespace App\Services;

use App\Models\Polyclinic;
use Exception;

class PolyclinicService
{
    public function findAll()
    {
        $data = Polyclinic::all();

        if ($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function store(array $request)
    {
        try {
            Polyclinic::create($request);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function update(array $request, $id)
    {
        $data = Polyclinic::where('id', $id);

        if ($data->count() > 0) {
            $data->update($request);
            return true;
        } else {
            return false;
        }
    }

    public function findById($id)
    {
        $data = Polyclinic::with('doctors')->where('id', $id)->get();
        
        if ($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function findByName($name)
    {
        $data = Polyclinic::where('name', 'like', '%' . $name . '%')->get();

        if ($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function deleteById($id)
    {
        $data = Polyclinic::find($id);

        if ($data != null) {
            $data->delete();
            return true;
        } else {
            return false;
        }
    }
}
