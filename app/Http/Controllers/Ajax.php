<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class Ajax extends Controller{

    public function review(string $id){
        $mainObject = Recipe::with(
            'comments:id,user_id,recipe_id,content,created_at',
            'comments.user:id,first_name,last_name',
            'comments.replies:user_id,comment_id,content,created_at',
            'comments.replies.user:id,first_name,last_name',
        )->select('id')->find($id);
        return view('reviewsAjax', ['comments' => $mainObject]);
    }
    /* 
    |   Docu: This method is used for getting the rating of a recipe using id
    */
    public function rating(string $id){
        $ratingModel = new Rating;
        $alreadyRated = $ratingModel->where('user_id', Auth::id())->where('recipe_id', $id)->exists();
        $data = [];
        for($index = 5; $index > 0; $index--){
            $data[$index] = $ratingModel->where('recipe_id', $id)->where('rating', $index)->count();
        }
        return view('rating', ['rating_data' => $data, 'alreadyRated' => $alreadyRated]);
    }
}
