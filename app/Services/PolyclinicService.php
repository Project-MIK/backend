<?php

namespace App\Services;

use App\Models\Polyclinic;
use Exception;

class PolyclinicService
{
    private Polyclinic $polyclinic;

    public function __construct()
    {
        $this->polyclinic = new Polyclinic();
    }

    public function findAll()
    {
        $data = $this->polyclinic->get();
        return $data;
    }

    public function store(array $request)
    {
        try {
            $this->polyclinic->create($request);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function update(array $request, Polyclinic $polyclinic)
    {
        if ($this->polyclinic->where('id', '=', $polyclinic->id)->count() > 0) {
            $data = $this->polyclinic->find($polyclinic->id);
            $data->update($request);
            return true;
        } else {
            return false;
        }
    }

    public function findById($id)
    {
        $data = $this->polyclinic->where('id', $id)->first();
        return $data;
    }

    public function findByName(string $name)
    {
        $data = $this->polyclinic->where('name', 'like', '%' . $name . '%')->get();
        return $data;
    }

    public function deleteById($id)
    {
        $data = $this->polyclinic->where('id', $id)->first();

        if ($data != null) {
            $data->delete();
            return true;
        } else {
            return false;
        }
    }
}
