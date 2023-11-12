<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class Ratings extends Controller{
    
    public function create(Request $request){
        $ratingModel = new Rating;
        $request->validate($ratingModel->validations());
        $ratingModel->recipe_id = $request->input('recipe_id');
        $ratingModel->rating = $request->input('rating');
        $ratingModel->user_id = Auth::id();
        $ratingModel->save();
        return redirect()->route('Ajax.rating');
    }

}
