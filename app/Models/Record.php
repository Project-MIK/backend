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
        "id_recipe"
    ];


    
}
