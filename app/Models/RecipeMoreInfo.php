<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeMoreInfo extends Model{
    use HasFactory;

    protected $fillable = ['recipe_id', 'duration', 'good_for', 'difficulty', 'budget'];

}
