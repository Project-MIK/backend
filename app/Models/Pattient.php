<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pattient extends Authenticatable
{
    use HasFactory;

    protected $table = "pattient";

    protected $fillable = [
        'name',
        'email',
        'gender',
        'password',
        'phone_number',
        'address',
        'citizen',
        'profession',
        'date_birth',
        'blood_group',
        'place_birth' ,
        'nik' , 
        'no_paspor',
        'medical_record_id'
    ];

    protected $hidden = ['password'];

    public function getRouteKeyName()
    {
        return "id";
    }
    public $timestamps = true;

   
}