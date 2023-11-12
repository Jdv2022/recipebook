<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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
    
    public function user(){
        return $this->belongsTo(User::class);
    }

}
