<?php 

namespace App\Services;

use App\Models\Doctor;
use Exception;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class DoctorService {
    public function findAll() 
    {
        $data = Doctor::with('schedules')->get()->toArray();

        if ($data == null) {
            return null;
        } else {
            return $data;
        }
    }

    public function findByPolyclinic($id)
    {
        $data = Doctor::where('polyclinic_id', $id)->get()->toArray();

        if ($data == null) {
            return null;
        } else {
            return $data;
        }
    }

    public function findById($id) 
    {
        $data = Doctor::with('schedules')->where('id', $id)->first();

        if ($data == null) {
            return null;
        } else {
            return $data->toArray();
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
        $data = Doctor::find($id);

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

    public function login(array $request)
    {
        $response = Auth::guard('doctor')->attempt($request);

        return $response;
    }
}