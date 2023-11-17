<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Commons;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class Mains extends Controller{
    /* 
    |   Docu: Main page
    */
    public function index(){
        $toRender = [
            'latest_section' => $this->latestSection(), 
        ];
        return view('index', $toRender);
    }
    /* 
    |   Docu: Process per section of the home page. (3 processes)
    */
    private function latestSection(){
        $recipeModel = Recipe::
            with([
                'user:id,first_name,last_name,email,updated_at',
                'rating:recipe_id,rating'
            ])
            ->select('id', 'user_id', 'title', 'description', 'url', 'updated_at')
            ->latest()
            ->take(8)
            ->get();

        foreach($recipeModel as &$item){
            if(count($item->rating) > 0){
                $item['rate'] = $this->sortRatings($item->rating);
            }
            else{
                $item['rate'] = ['count' => 0, 'rating' => 0];
            }
        }
        return $recipeModel;
    }
    private function sortRatings($params){
        $count = 0;
        $rating = 0;
        foreach($params as $item){
            $count++;
            $rating += $item->rating; 
        }
        $params->count = $count;
        $params->rating = $rating;
        return ['count' => $count, 'rating' => round($rating/$count, 2)];
    }
    /* 
    |   Docu: Show recipe info
    */
    public function viewRecipe(string $id){
        $recipeModel = new Recipe;
        $ratingMOdel = new Rating;
        $data = $recipeModel->find($id);
        $subImages = [];
        $count = 0;
        $rate = 0;
        if($ratingMOdel->count() !== 0){
            $rate = $ratingMOdel->sum('rating')/$ratingMOdel->count();
        }
        foreach($data->subPictures as $sub){    //organise the sub-recipe-picture for easy display
            $subImages[$count] = $sub['url']; 
            $count++;
        }
        return view('viewRecipe', 
            [
                'data' => $data, 
                'original_ingredients' => $data['list_of_ingredients'],
                'original_instructions' => $data['instructions'],
                'ingredients' => explode("~", $data['list_of_ingredients']), 
                'instruction' => explode("~", $data['instructions']), 
                'rate' => $rate, 
                'num_people_rate' => $ratingMOdel->count(),
                'user_data' => $data->user,
                'recipe_add_info' => $data->moreInfo,
                'sub_pictures' => $subImages,
            ]
        );
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
        $user = new User;
        $userData = $user->find($id);
        $recipeData = $userData->recipes;
        $img = $userData->userPicture;
        $moreInfo = $userData->moreUserInfo;
        $ratingMOdel = new Rating;
        $rate = 0;
        $count = $ratingMOdel->count();
        if($count){
            $rate = $ratingMOdel->sum('rating')/$count;
        }
        return view('profile',[ 
            'user_data' => $userData, 
            'img' => $img, 
            'more_info' => $moreInfo, 
            'recipe' => $recipeData, 
            'rate' => $rate,
            'num_people_rate' => $count,
        ]);
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
        return view('searchResult', ['result' => $integratedData]);
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
