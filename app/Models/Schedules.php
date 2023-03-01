<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id'];

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }

    public function scheduleDetails() {
        return $this->hasMany(ScheduleDetail::class);
    }
}