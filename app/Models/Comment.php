<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Reply;
use App\Models\User;

class Comment extends Model{
    use HasFactory;

    public function validation(){
        return [
            'comment-input' => 'required',
        ];
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
