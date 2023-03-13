<?php 

namespace App\Services;

use App\Models\Schedule;
use Exception;
use Illuminate\Support\Facades\DB;

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
        $data = Schedule::with('scheduleDetails')->where('id', $id)->get()->toArray();

        if($data == null) {
            return null;
        } else {
            return $data;
        }
    }

    public function findByDoctor($id)
    {
        $data = Schedule::with('scheduleDetails')->where('doctor_id', $id)->get()->toArray();

        if($data == null) {
            return null;
        } else {
            return $data;
        }
    }
    
    public function findByDoctorAndDate($id, $date)
    {
        // $data = Schedule::with('scheduleDetails')->where('doctor_id', $id)->whereDate('consultation_date', $date)->get()->toArray();
        $data = DB::table('schedules')
                ->join('schedule_details', 'schedules.id', '=', 'schedule_details.schedule_id')
                ->where('doctor_id', $id)
                ->whereDate('consultation_date', $date)
                ->get()
                ->toArray();

        if($data == null) {
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