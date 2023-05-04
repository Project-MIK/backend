<?php 

namespace App\Services;

use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use Exception;

class ScheduleDetailService {
    public function findAllSchedules() {
        $data = ScheduleDetail::with('schedule.doctor')->orderBy('consultation_date')->get();

        return $data;
    }

    public function findAllDoctors()
    {
        $data = Doctor::orderBy('name')->get();

        return $data;
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

    public function add(array $request, string $id) {
        try {
            $schedule = Schedule::create([
                'doctor_id' => $id
            ]);

            $schedule->scheduleDetails()->create([
                'consultation_date' => date('Y-m-d', strtotime($request['consultation_date'])),
                'time_start' => $request['time_start'],
                'time_end' => $request['time_end'],
                'link' => '',
                'status' => 'kosong'
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function change(array $request, string $doctor, string $id) {
        try {
            $schedule = ScheduleDetail::find($id);

            $schedule->schedule()->update([
                'doctor_id' => $doctor
            ]);

            $schedule->update([
                'consultation_date' => date('Y-m-d', strtotime($request['consultation_date'])),
                'time_start' => $request['time_start'],
                'time_end' => $request['time_end'],
            ]);

            return true;
        } catch (Exception $e) {
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