<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        "id" ,
        "name" , 
        "email" , 
        "address" , 
        "password"
    ];

    protected $hidden = ["password"];

    protected $table = "admin";

    public function getRouteKeyName(){
        return "id";
    }

    

    public $timestamps = true;

}
