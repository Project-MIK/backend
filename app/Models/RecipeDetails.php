<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_recipe" , 
        "id_medicine",
        "qty",
        "total_price",
    ];

    protected $table = 'recipe_detail';

    
}
