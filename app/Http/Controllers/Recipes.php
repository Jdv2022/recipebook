<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Recipe;

class Recipes extends Controller{
    
    public function createRecipes(Request $request){
        $model = new Recipe;
        $validate = $request->validate($model->recipeValidations());
        $uploadedFile = $request->file('food_picture');
        $path = $uploadedFile->store('public/user');

        $model->user_id = Auth::id();
        $model->title = $request->input('title');
        $model->description = $request->input('description');
        $model->list_of_ingredients = $request->input('list_of_ingredients');
        $model->instructions = $request->input('instructions');
        $model->url = $path;

        if($model->save()){
            dd('Saved!');
        }
        dd('Not saved!');
    }
    
}
