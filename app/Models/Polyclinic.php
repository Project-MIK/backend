<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polyclinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'record_category_id'
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function record_category()
    {
        return $this->belongsTo(RecordCategory::class);
    }
}
