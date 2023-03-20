<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'no_rek',
        'atas_nama'
    ];
    public $incrementing = false;

    protected $table = 'payment_metode';

}