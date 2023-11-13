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
        $uploadedFile->store('public/user');

        $model->user_id = Auth::id();
        $model->title = $request->input('title');
        $model->description = $request->input('description');
        $model->list_of_ingredients = $request->input('list_of_ingredients');
        $model->instructions = $request->input('instructions');
        $model->url = 'storage/user/' . $uploadedFile->hashName();

        if($model->save()){
            dd('Saved!');
        }
        dd('Not saved!');
    }

    public function edit(Request $request, $id){
        $recipeModel = new Recipe;
        $row = $recipeModel->find($id);
        $request->validate(['hidden' => 'required']);
        $selection = [
            'edit-modal-title' => $this->title($row, $request->input('title')),
        ];
        $selection[$request->input('hidden')];
        return redirect()->route('Main.viewRecipe', $id);
    }

    public function title($model, $params){
        $model->title = $params;
        $model->save();
    }
    
}
