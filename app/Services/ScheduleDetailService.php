<?php 

namespace App\Services;

use App\Models\ScheduleDetail;
use Exception;

class ScheduleDetailService {
    public function findAll() {
        $data = ScheduleDetail::all();

        if($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function findById($id) {
        $data = ScheduleDetail::where('id', $id)->get();

        if($data->isEmpty()) {
            return null;
        } else {
            return $data;
        }
    }

    public function updateStatus(string $id, string $status)
    {
        $data = ScheduleDetail::where('id', $id)->update([
            'status' => $status
        ]);

        return $data;
    }

    public function add(array $request) {
        try {
            ScheduleDetail::create($request);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function change(array $request, $id) {
        $data = ScheduleDetail::find($id);

        if($data != null) {
            $data->update($request);
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $data = ScheduleDetail::find($id);

        if($data != null) {
            $data->delete();
            return true;
        } else {
            return false;
        }
    }
}