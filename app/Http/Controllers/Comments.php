<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class Comments extends Controller{

    /* 
    |   Docu: Insert comments, redirect to ajax controller
    */
    public function create(Request $request){
        $request->validate(Comment::createValidation());
        $request['user_id'] = Auth::id();
        Comment::create($request->all());
        return redirect()->route('Ajax.review', $request->input('recipe_id'));
    }
}
