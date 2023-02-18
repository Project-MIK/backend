<?php 

namespace App\Services;

use App\Models\Doctor;
use Exception;

use function PHPUnit\Framework\isEmpty;

class DoctorService {
    public function findAll() 
    {
        $data = Doctor::with('polyclinic')->orderBy('name')->get();

        if ($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function findById($id) 
    {
        $data = Doctor::with('polyclinic')->where('id', $id)->get();

        if ($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function add(array $request) 
    {
        try {
            Doctor::create($request);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function change(array $request, $id)
    {
        $data = Doctor::where('id', $id);

        if ($data->count() > 0) {
            $data->update($request);
            return true;
        } else {
            return false;
        }
    }

    public function deleteById($id)
    {
        $data = Doctor::find($id)->polyclinic()->first();

        if ($data != null) {
            $data->delete();
            return true;
        } else {
            return false;
        }
    }

    public function findByName($name)
    {
        $data = Doctor::with('polyclinic')->where('name', 'like', '%' . $name . '%')->orderBy('name')->get();

        if ($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function findByGender($gender)
    {
        $data = Doctor::with('polyclinic')->where('gender', $gender)->orderBy('name')->get();

        if ($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }
}