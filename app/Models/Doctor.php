<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctor';
    protected $fillable = [
        'name',
        'gender',
        'address',
        'phone',
        'polyclinic_id',
    ];

    public function polyclinic()
    {
        return $this->belongsTo(Polyclinic::class);
    }
}
