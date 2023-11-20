<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Helpers\Commons;
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
            'featured_user' => $this->featuredSection(), 
            'featured_recipes' => $this->featuredRecipe(), 
            'viewName' => 'index',
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
    private function featuredSection(){
        $unsorted;
        $userModel = User::with(
            'moreUserInfo:user_id,about_me,location', 
            'userPicture:user_id,profile_url,cover_url',
            'recipes:id,user_id',
            'recipes.rating:recipe_id,rating'
            )
            ->select(['id', 'first_name', 'last_name', 'created_at'])
            ->get();
            
        foreach($userModel as &$items){
            $count = 0;
            $sum = 0;
            $items['time'] = date("F j, Y", strtotime($items['created_at']));
            $items['total_recipes'] = count($items->recipes);
            unset($items['created_at']);
            foreach($items->recipes as &$item){
                if(count($item->rating) > 0){
                    $result = $this->sortRatings($item->rating);
                    $count += $result['count'];
                    $sum += $result['rating'];
                }
            }
            if($count > 0){
                $items['rate'] = ['count' => $count, 'rating' => $sum];
            }
            else{
                $items['rate'] = ['count' => 0, 'rating' => 0];
            }
        }
        $sorted = array_slice(Commons::sortThis($userModel->toarray()), 0, 5);
        return $sorted;
    }
    private function featuredRecipe(){
        $unsorted;
        $userModel = Recipe::with(
            'rating:recipe_id,rating',
            'user:id,first_name,last_name'
            )
            ->select(['id', 'user_id', 'title', 'description', 'url', 'created_at'])
            ->get();
            
        foreach($userModel as &$items){
            if(count($items->rating) > 0){
                $items['rate'] = $this->sortRatings($items->rating);
            }
            else{
                $items['rate'] = ['count' => 0, 'rating' => 0];
            }
        }
        $sorted = array_slice(Commons::sortThis($userModel->toarray()), 0, 9);
        return $sorted;
    }
    //calculate the average rating.returns the total number of participated user and rating
    private function sortRatings($params){
        $count = 0;
        $sum = 0;
        foreach($params as $item){
            $count++;
            $sum += $item->rating; 
        }
        if($count != 0){
            return ['count' => $count, 'rating' => round($sum/$count, 2)];
        }
        return ['count' => $count, 'rating' => 0];
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
                )
            ->find($id);
        $recipeModel->list_of_ingredients_sorted = explode("~", $recipeModel['list_of_ingredients']);
        $recipeModel->instructions_sorted = explode("~", $recipeModel['instructions']);
        $recipeModel->rate = $this->sortRatings($recipeModel['rating']);
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
            $item['rate'] = $this->sortRatings($item['rating']);
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
