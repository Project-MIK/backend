<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordCategory extends Model
{
    use HasFactory;

    protected $table = "record_category";
    protected $fillable = [
        "category_name"
    ];

    public function polyclinics()
    {
        $this->hasMany(Polyclinic::class);
    }

}
