<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\RecipeMoreInfo;
use App\Models\RecipePicture;
use Illuminate\Support\Facades\Storage;

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
            $moreModel = new RecipeMoreInfo;
            $moreModel->recipe_id = $model->id;
            $moreModel->duration = "";
            $moreModel->good_for = "";
            $moreModel->difficulty = "";
            $moreModel->budget = "";
            $moreModel->save();
            return redirect()->route('Main.viewRecipe', $model->id);
        }
        return redirect()->back();
    }
    /* 
    |   Docu: Serve as reverse proxy for edit recipes
    */
    public function edit(Request $request, $id){
        $recipeModel = new Recipe;
        $row = $recipeModel->find($id);
        $selection = [
            'edit-title-modal' => 'title',
            'edit-description-modal' => 'description',
            'edit-otherDetails-modal' => 'otherDetails',
            'edit-ingredients-modal' => 'ingredients',
            'edit-method-modal' => 'instruction',
            'main_recipeImg_modal' => 'mainImg',
            'main_sub_modal' => 'subImg',
        ];

        foreach($selection as $key => $value){
            if($key === $request->input('hidden')){
                $this->{$value}($row, $request, $id);
            }
        }

        return redirect()->route('Main.viewRecipe', $id);
    }
    /* 
    |   Docu: This is use for edit method
    */
    public function title($model, $request){
        $request->validate(['hidden' => 'required', 'title'=> 'required']);
        $model->title = $request->input('title');
        $model->save();
    }

    public function description($model, $request){
        $request->validate(['hidden' => 'required', 'description' => 'required']);
        $model->description = $request->input('description');
        $model->save();
    }

    public function otherDetails($model, $request){
        $otherDetailsModel = $model->moreInfo;
        $request->validate([
            'hidden' => 'required',
            'duration' => 'required|max:20',
            'good_for' => 'required|max:20',
            'difficulty' => 'required|max:20',
            'budget' => 'required|max:20',
        ]);
        $otherDetailsModel->duration = $request->input('duration');
        $otherDetailsModel->good_for = $request->input('good_for');
        $otherDetailsModel->difficulty = $request->input('difficulty');
        $otherDetailsModel->budget = $request->input('budget');
        $otherDetailsModel->save();
    }

    public function ingredients($model, $request){
        $request->validate(['hidden' => 'required', 'ingredients' => 'required']);
        $model->list_of_ingredients = $request->input('ingredients');
        $model->save();
    }

    public function instruction($model, $request){
        $request->validate(['hidden' => 'required', 'method' => 'required']);
        $model->instructions = $request->input('method');
        $model->save();
    }

    public function mainImg($model, $request){
        $request->validate([
            'hidden' => 'required', 
            'main_recipe_img' => 'required|mimes:jpg,jpeg,png',
        ]);
        Storage::delete($request->input('original_url')); //delete the existing image
        $uploadedFile = $request->file('main_recipe_img'); 
        $uploadedFile->store('public/user'); //new replacement

        $url = 'storage/user/' . $uploadedFile->hashName();
        $model->updateOrCreate(
            ['url' => $request->input('original_url')],
            ['url' => $url]
        );
    } 

    public function subImg($model, $request, $id){
        $recipePictureModel = new RecipePicture;
        $img = $request->input('original_url');
        $request->validate([
            'hidden' => 'required', 
            'main_recipe_img' => 'required|mimes:jpg,jpeg,png',
        ]);
        if($img){
            Storage::delete($img); //delete the existing image
        }
        $uploadedFile = $request->file('main_recipe_img'); 
        $uploadedFile->store('public/user'); //new replacement
        $url = 'storage/user/' . $uploadedFile->hashName();
        if($recipePictureModel->where('url', $img)->exists()){
            $existingRecord = $recipePictureModel->where('url', $img)->first();
            $existingRecord->url = $url;
            $existingRecord->recipe_id = $id; 
            $existingRecord->save();
        }
        else{
            $recipePictureModel->recipe_id = $id;
            $recipePictureModel->url = $url;
            $recipePictureModel->save();
        }
    }
    
    public function delete($id){
        $model = new Recipe;
        $row = $model->find($id);
        $row->delete();
        return redirect()->route('Main.profile', Auth::id());
    }
    /* 
    |   End of use for edit method
    */
}
