<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reply;
use App\Models\User;

class Comment extends Model{

    use HasFactory;

    protected $fillable = ['user_id','recipe_id','content'];

    public static function createValidation(){
        return ['content' => 'required',];
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
