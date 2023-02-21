<?php

namespace App\Models;

use App\Http\Requests\RegistrationOfficersRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationOfficers extends Model
{   
    use HasFactory;


    protected $fillable = [
        "id" ,
        'name',
        'email',
        'password',
        "gender" , 
        "address"
    ];

    protected $hidden = ['password'];
}
