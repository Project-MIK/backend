<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecoveryAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        "token",
        "expired",
        "id_pattient",
    ];

    protected $hidden = ["id"];
    protected $table = "recovery_pattient";
}