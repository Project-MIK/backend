<?php 

namespace App\Services;

use App\Models\Doctor;
use Exception;

use function PHPUnit\Framework\isEmpty;

class DoctorService {
    public function findAll() {
        $data = Doctor::all();

        if ($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function findById($id) {
        $data = Doctor::with('polyclinic')->where('id', $id)->get();

        if ($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }
}