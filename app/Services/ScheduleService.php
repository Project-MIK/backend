<?php 

namespace App\Services;

use App\Models\Schedule;
use Exception;

class ScheduleService {
    public function findAll() {
        $data = Schedule::all();

        if($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function findById($id) {
        $data = Schedule::where('id', $id)->get();

        if($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function add(array $request) {
        try {
            Schedule::create($request);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function change(array $request, $id) {
        $data = Schedule::find($id);

        if($data != null) {
            $data->update($request);
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $data = Schedule::find($id);

        if($data != null) {
            $data->delete();
            return true;
        } else {
            return false;
        }
    }
}