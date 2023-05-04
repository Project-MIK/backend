<?php 

namespace App\Services;
use App\Models\Doctor;
use App\Models\Polyclinic;
use App\Models\ScheduleDetail;
use Illuminate\Database\Eloquent\Collection;

class ConsultationService {
    public function findPolyclinicsByCategory(string $id): Collection
    {
        $polyclinics = Polyclinic::whereHas('doctors', function ($query) use($id) {
            $query->where('record_category_id', $id);
        })->get();

        return $polyclinics;
    }

    public function findDoctorsByPolyclinic(string $id): array
    {
        $doctors = Doctor::with(['schedules' => function ($query) {
            $query->whereDate('consultation_date', ">", now())->where('status', "=", "kosong");
        }])->where('polyclinic_id', $id)->get();

        return $doctors->toArray();
    }

    public function findScheduleByDate(string $doctor, string $date)
    {
        // $schedules = ScheduleDetail::whereDate('consultation_date', date('Y-m-d', strtotime($date)))->first();
        $schedules = ScheduleDetail::with(['schedule' => function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor);
        }])->whereDate('consultation_date', date('Y-m-d', strtotime($date)))->first();

        return $schedules;
    }
}