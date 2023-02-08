<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattient extends Model
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
        'place_birth'
    ];

    protected $hidden = ['password'];

    public function getRouteKeyName()
    {
        return "id";
    }
    public $timestamps = true;
}