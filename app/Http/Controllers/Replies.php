<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reply;

class Replies extends Controller{
    /* 
    |   Docu: Insert replies, redirect to ajax controller
    */
    public function create(Request $request){
        $model = new Reply;
        $request->validate($model->validations());
        $model->user_id = Auth::id();
        $model->comment_id = $request->input('id');
        $model->content = $request->input('comment-reply');
        $model->save();
        return redirect()->route('Ajax.review');
    }
    
}
