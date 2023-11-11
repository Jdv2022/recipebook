<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Reply extends Model{
    use HasFactory;

    public function validations(){
        return [
            'id' => 'required',
            'comment-reply' => 'required',
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
