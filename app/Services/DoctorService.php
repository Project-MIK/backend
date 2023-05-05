<?php

namespace App\Services;

use App\Models\Doctor;
use App\Models\Polyclinic;
use Exception;
use Illuminate\Support\Facades\Auth;

class DoctorService
{
    public function findAllDoctors()
    {
        $data = Doctor::with(['polyclinic', 'schedules'])->get()->toArray();

        return $data;
    }

    public function findAllDoctorSchedules($id)
    {
        $data = Doctor::with('schedules')->where('id', $id)->first();

        return $data;
    }

    public function findAllPolyclinics()
    {
        $data = Polyclinic::all();

        return $data;
    }

    public function findByPolyclinic($id)
    {
        // $data = Doctor::where('polyclinic_id', $id)->get()->toArray();\
        $data = Doctor::with('schedules')->where('polyclinic_id', $id)->get()->toArray();

        if ($data == null) {
            return null;
        } else {
            return $data;
        }
    }

    public function findById($id)
    {
        $data = Doctor::with(['schedules', 'polyclinic'])->where('id', $id)->first();

        if ($data == null) {
            return null;
        } else {
            return $data->toArray();
        }
    }

    public function add(array $request)
    {
        try {
            Doctor::create([
                'name' => $request['name'],
                'gender' => $request['gender'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'polyclinic_id' => $request['polyclinic_id'],
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function change(array $request, $id)
    {
        $data = Doctor::where('id', $id);

        if ($data->count() > 0) {
            $data->update([
                'name' => $request['name'],
                'gender' => $request['gender'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'polyclinic_id' => $request['polyclinic_id'],
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function changeSetting(array $request, string $id)
    {
        $doctor = Doctor::where('id', $id);

        if ($doctor->count() > 0) {
            $doctor->update([
                'name' => $request['name'],
                'gender' => $request['gender'],
                'address' => $request['address'],
                'phone' => $request['phone'],
            ]);

            return true;
        }

        return false;
    }

    public function changeEmail(array $email, string $id)
    {
        $doctor = Doctor::where('id', $id);

        if ($doctor->count() > 0) {
            $doctor->update($email);

            return true;
        }

        return false;
    }

    public function changePassword(array $request, string $id)
    {
        $doctor = Doctor::where('id', $id);

        if ($doctor->count() > 0) {
            $doctor->update([
                'password' => bcrypt($request['password'])
            ]);

            return true;
        }

        return false;
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
