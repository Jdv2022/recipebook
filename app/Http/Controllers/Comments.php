<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class Comments extends Controller{
    /* 
    |   Docu: Insert comments, redirect to ajax controller
    */
    public function create(Request $request){
        $model = new Comment;
        $validate = $request->validate($model->validation());
        $model->user_id = Auth::id();
        $model->content = $request->input('comment-input'); 
        $model->save();
        return redirect()->route('Ajax.review');
    }
}
