<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\Commons;
use App\Models\Recipe;
use App\Models\User;

class Mains extends Controller{
    /* 
    |   Docu: Main page
    */
    public function index(){
        $recipeModel = new Recipe;
        $recipeResult = $recipeModel->take(6)->get();
        $data = $this->organiseData($recipeResult);
        $featuredUser = $this->userDetails();
        return view('index',['recipes'=>$data[0], 'featured_user'=> $featuredUser, 'featuredRecipes'=>$data[1]]);
    }
    public function userDetails(){
        $user = new User;
        $find = $user->take(6)->get(); 
        $data = [];
        foreach($find as $item){
            $moreDetails = $item->moreUserInfo()->first();
            $timestamp = strtotime($item['created_at']);
            $formattedDate = date("F d, Y", $timestamp);
            $data[] = [
                'first_name' => $item['first_name'],
                'last_name' => $item['last_name'],
                'created_at' => $formattedDate,
                'about_me' => (isset($moreDetails['about_me']))?$moreDetails['about_me']:"",
                'education' => (isset($moreDetails['education']))?$moreDetails['education']:"",
            ];
        }
        return $data;
    }
    /* 
    |   Docu: Show recipe info
    */
    public function viewRecipe(string $id){
        $recipeModel = new Recipe;
        $data = $recipeModel->find($id);
        $ingredients = explode("~", $data['list_of_ingredients']);
        $instructions = explode("~", $data['instructions']);
        return view('viewRecipe', ['data' => $data, 'ingredients' => $ingredients, 'instruction' => $instructions]);
    }
    /* 
    |   Docu: This method is used for rendering create recipe form. This is Auth route protected. 
    */
    public function recipeUserInput(){
        return view('createRecipe');
    }
    /* 
    |   Docu: This method organizes an array of data to be rendered in index.blade.html
    */
    public function organiseData($query){
        $data = [];
        foreach($query->toarray() as $item0){
            $commonFunctions = new Common;
            $timeDifference = $commonFunctions->getTimeAgo($item0['updated_at']);
            $data[] = [
                'id' => $item0['id'],
                'title' => $item0['title'],
                'description' => $item0['description'],
                'url' => $item0['url'],
                'time' => $timeDifference,
            ];
        }
        $finalRecipe = array_chunk($data, 3);
        $featuredRecipe = array_chunk($data, 2);
        return [$finalRecipe, $featuredRecipe];
    }
    
}
