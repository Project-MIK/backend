<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipes extends Model
{
    use HasFactory;
    protected $fillable = [
        "description",
        "price_medical_prescription",
        "pickup_medical_prescription" , 
        "pickup_medical_status",
        "pickup_medical_addreass_pacient",
        "pickup_medical_description",
        "pickup_datetime"
    ];
    protected $table = 'recipes';
    
}
