<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicines extends Model
{
    use HasFactory;

    protected $fillable = [
        "id" ,
        "name", 
        "price", 
        "stock" 
    ];



    protected $table = "medicines";

    public function getRouteKeyName(){
        return "id";
    }
    

    public $timestamps = true;
}
