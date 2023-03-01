<?php 

namespace App\Services;

use App\Models\Schedules;
use Exception;

class ScheduleService {
    public function findAll() {
        $data = Schedules::all();

        if($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function findById($id) {
        $data = Schedules::where('id', $id)->first();

        if($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function add(array $request) {
        try {
            Schedules::create($request);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function change(array $request, $id) {
        $data = Schedules::find($id);

        if($data->count() > 0) {
            $data->update($request);
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $data = Schedules::find($id);

        if($data != null) {
            $data->delete();
            return true;
        } else {
            return false;
        }
    }
}