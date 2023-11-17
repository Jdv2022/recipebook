<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserPicture extends Model{
    use HasFactory;

    protected $fillable = ['profile_url, cover_url']; 

    public function user(){
        return $this->belongsTo(User::class);
    }

}
