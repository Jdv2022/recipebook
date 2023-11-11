<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model{
    use HasFactory;

    public function recipeValidations(){
        return [
            'hidden' => 'required',
            'title' => 'required',
            'description' => 'required',
            'list_of_ingredients' => 'required',
            'instructions' => 'required',
            'food_picture' => 'required|mimes:jpeg,png,jpg',
        ];
    }

}