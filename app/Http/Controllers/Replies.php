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
        $request->validate(Reply::validations());
        $request['user_id'] = Auth::id();
        Reply::create($request->all());
        return redirect()->route('Ajax.review', $request->input('comment_id'));
    }
    
}
