<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'address',
        'phone',
        'polyclinic_id',
    ];

    public function polyclinic() :BelongsTo
    {
        return $this->belongsTo(Polyclinic::class);
    }

    public function schedules() :HasManyThrough
    {
        return $this->hasManyThrough(ScheduleDetail::class, Schedule::class);
    }
}
