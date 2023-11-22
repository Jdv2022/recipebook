<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\RecipeMoreInfo;
use App\Models\Rating;
use App\Models\Comment;

class Recipe extends Model{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'list_of_ingredients', 'instructions', 'url'];

    public static function createRecipeValidation(){
        return [
            'hidden'                => 'required',
            'title'                 => 'required',
            'description'           => 'required',
            'list_of_ingredients'   => 'required',
            'instructions'          => 'required',
            'profile_pic'           => 'required|mimes:jpeg,png,jpg',
        ];
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function moreInfo(){
        return $this->hasOne(RecipeMoreInfo::class);
    }

    public function subPictures(){
        return $this->hasMany(RecipePicture::class);
    }

    public function rating(){
        return $this->hasMany(Rating::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
