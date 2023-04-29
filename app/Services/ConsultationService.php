<?php 

namespace App\Services;
use App\Models\Doctor;
use App\Models\Polyclinic;
use Illuminate\Database\Eloquent\Collection;

class ConsultationService {
    public function findPolyclinicsByCategory(string $id): Collection
    {
        $polyclinics = Polyclinic::where('record_category_id', $id)->get();

        return $polyclinics;
    }

    public function findDoctorsByPolyclinic(string $id): Collection
    {
        $doctors = Doctor::with('schedules')->where('polyclinic_id', $id)->get();

        return $doctors;
    }
}