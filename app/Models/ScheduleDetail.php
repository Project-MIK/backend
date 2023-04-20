<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    use HasFactory;


    protected $fillable = [
        'consultation_date',
        'time_start',
        'time_end',
        'link',
        'status',
        'schedule_id'
    ];

    public function schedules()
    {
        return $this->belongsTo(Schedules::class);
    }
    protected $table = "schedule_details";
}
