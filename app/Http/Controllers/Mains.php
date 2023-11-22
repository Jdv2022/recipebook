<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Commons;
use App\Http\Controllers\Recipes;
use App\Http\Controllers\Users;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Rating;

class Mains extends Controller{
    /* 
    |   Docu: Main page
    */
    public function index(){
        $toRender = [
            'latest_section' => Recipes::latestSection(), 
            'featured_user' => Users::featuredSection(), 
            'featured_recipes' => Recipes::featuredRecipe(), 
        ];
        return view('index', $toRender);
    }

    /* 
    |   Docu: Show recipe info
    */
    public function viewRecipe(string $id){
        if(!Recipe::where('id', $id)->exists()){
            return redirect()->route('Main.index');
        }
        $recipeModel = Recipe::with(
                'user:id,first_name,last_name',
                'subPictures:recipe_id,url',
                'moreInfo:recipe_id,duration,good_for,difficulty,budget',
                'rating:recipe_id,rating',
                'comments:id,user_id,recipe_id,content,created_at',
                'comments.user:id,first_name,last_name',
                'comments.replies:id,user_id,content,created_at',
            )->find($id);
        $recipeModel->list_of_ingredients_sorted = explode("~", $recipeModel['list_of_ingredients']);
        $recipeModel->instructions_sorted = explode("~", $recipeModel['instructions']);
        $recipeModel->rate = Commons::sortRatings($recipeModel['rating']);
        return view('viewRecipe', ['recipe_data' => $recipeModel, 'viewName' => 'viewRecipe']);
    }
    /* 
    |   Docu: This method is used for rendering create recipe form. This is Auth route protected. 
    */
    public function recipeUserInput(){
        return view('createRecipe');
    }
    /* 
    |   Docu: Profile viewing
    */
    public function profile(string $id){
        if(!User::where('id', $id)->exists()){
            return redirect()->route('Main.index');
        }
        $user = User::with(
            'moreUserInfo:id,user_id,about_me,location',
            'userPicture:id,user_id,profile_url,cover_url',
            'recipes:id,user_id,title,description,url,created_at',
            'recipes.rating:id,recipe_id,rating'
            )->select('id','first_name','last_name','email','created_at')->find($id);
        foreach($user['recipes'] as &$item){
            $item['rate'] = Commons::sortRatings($item['rating']);
        }
        return view('profile', ['user_data' => $user]);
    }
    /* 
    |   Docu: Edit recipe
    */
    public function editRecipe(string $id){
        return view('editRecipe');
    }

    /* 
    |   Docu: handles search. Tables recipe and user. 
    */
    public function search(Request $keyword){
        $keyword->validate(['search' => 'required']);
        $word = $keyword->input('search');
        $recipeResult = Recipe::where('title', 'LIKE', '%'.$word.'%')->get();
        $integratedData = $this->recipeRating($recipeResult);
        return view('searchResult', ['result' => $integratedData, 'viewName' => 'searchResult']);
    }

    /* 
    |   Docu: Combine Recipe and Recipe-rating. Used for Search feature and index featured section
    */
    public function recipeRating($params){
        $data = [];
        foreach($params as $item){
            $new = $item->rating;
            $user = $item->user;
            $rate;
            if($new->count() === 0){
                $rate = 0;
            }
            else{
                $rate = $new->sum('rating')/$new->count();
            }
            $rating = [
                'rating' => $rate,
                'count' => $new->count(),
            ];
            $name = [
                'user_id' => $item['user_id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
            ];
            $data[] = [
                'id' => $item['id'],
                'owner' => $name,
                'title' => $item['title'],
                'description' => $item['description'],
                'url' => $item['url'],
                'rate' => $rating,
            ];
        }
        return $data;
    }   
    
}
