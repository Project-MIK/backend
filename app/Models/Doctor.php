<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'address',
        'phone',
        'email',
        'password',
        'polyclinic_id',
    ];

    public function polyclinic(): BelongsTo
    {
        return $this->belongsTo(Polyclinic::class);
    }

    public function schedules(): HasManyThrough
    {
        return $this->hasManyThrough(ScheduleDetail::class, Schedule::class, 'doctor_id', 'schedule_id', 'id', 'id');
    }

    protected $hidden = [
        'password'
    ];
}
