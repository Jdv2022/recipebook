<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\Models\Recipe;

class Mains extends Controller{

    public function index(){
        $recipeModel = new Recipe;
        $recipeResult = $recipeModel->take(6)->get();
        $data = [];
        foreach($recipeResult->toarray() as $item0){
            $updatedAt = Carbon::parse($item0['updated_at']);
            $currentTime = Carbon::now();
            $timeDifference = $this->getTimeAgo($updatedAt);
            $data[] = [
                'title' => $item0['title'],
                'description' => $item0['description'],
                'url' => $item0['url'],
                'time' => $timeDifference,
            ];
        }
        $finalRecipe = array_chunk($data, 3);
        return view('index',['recipes'=>$finalRecipe]);
    }

    public function recipeUserInput(){
        return view('createRecipe');
    }

    public function getTimeAgo($carbonObject) {
        return str_ireplace(
            [' seconds', ' second', ' minutes', ' minute', ' hours', ' hour', ' days', ' day', ' weeks', ' week'], 
            ['s', 's', 'm', 'm', 'h', 'h', 'd', 'd', 'w', 'w'], 
            $carbonObject->diffForHumans()
        );
    }
    
}
