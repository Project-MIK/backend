<?php 

namespace App\Services;
use App\Models\Doctor;
use App\Models\Polyclinic;
use App\Models\ScheduleDetail;
use Illuminate\Database\Eloquent\Collection;

class ConsultationService {
    public function findPolyclinicsByCategory(string $id): Collection
    {
        $polyclinics = Polyclinic::where('record_category_id', $id)->get();

        return $polyclinics;
    }

    public function findDoctorsByPolyclinic(string $id): array
    {
        $doctors = Doctor::with(['schedules' => function ($query) {
            $query->whereDate('consultation_date', ">", now());
        }])->where('polyclinic_id', $id)->get();

        return $doctors->toArray();
    }

    public function findScheduleByDate(string $date)
    {
        $schedules = ScheduleDetail::whereDate('consultation_date', date('Y-m-d', strtotime($date)))->first();

        return $schedules;
    }
}