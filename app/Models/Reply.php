<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Reply extends Model{
    
    use HasFactory;

    protected $fillable = ['user_id','comment_id','content'];

    public static function validations(){
        return [
            'comment_id' => 'required',
            'content'    => 'required',
        ];
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
