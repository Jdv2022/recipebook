<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserAdditionalDetails;
use App\Models\UserPicture;
use App\Models\Recipe;

class User extends Authenticatable{
    use HasFactory;

    public function registrationValidation(){
        return [
            'hidden' => 'required',
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ];
    }

    public function loginValidation(){
        return [
            'hidden' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ];
    }

    public function moreUserInfo(){
        return $this->hasone(UserAdditionalDetails::class);
    }

    public function userPicture(){
        return $this->hasone(UserPicture::class);
    }

    public function recipes(){
        return $this->hasMany(Recipe::class);
    }

}
