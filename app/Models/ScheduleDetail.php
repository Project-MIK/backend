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

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    protected $table = "schedule_details";
}
