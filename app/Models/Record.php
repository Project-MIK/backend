<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $table = "record";
    
    protected $fillable = [
        "id" ,
        "medical_record_id" , 
        "description" , 
        "complaint" , 
        "id_recipe" , 
        "doctor_id",
        "schedule_id",
        "id_category",
        'valid_status',
        'status_consultation', 
        'status_payment_consultation',
        'payment_method'
    ];
    
}
