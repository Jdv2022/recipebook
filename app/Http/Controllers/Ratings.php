<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class Ratings extends Controller{
    
    public function create(Request $request){
        $request->validate(Rating::validations());
        $request['user_id'] = Auth::id();
        Rating::create($request->all());
        return redirect()->route('Ajax.rating', $request['recipe_id']);
    }

}
