<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecords extends Model
{
    use HasFactory;



    protected $fillable = [
        "medical_record_id" ,
        "id_pattient" , 
        "id_admin", 
    ];

    protected $table = "medical_records";

    public function getRouteKeyName(){
        return "medical_record_id";
    }

    public $timestamps = true;
    
}
