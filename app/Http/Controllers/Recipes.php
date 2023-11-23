<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\RecipeMoreInfo;
use App\Models\RecipePicture;
use App\Http\Controllers\Commons;
use Illuminate\Support\Facades\Storage;

class Recipes extends Controller{

    public static function latestSection(){
        $total = Recipe::count();
        $existedrand = [];
        $index = 0;
        while($index < 8){
            $random = rand(1, $total);
            if(!in_array($random, $existedrand)){
                $existedrand[] = $random;
                $index++;
            }
        }
        $recipeModelGet = Recipe::
            with([
                    'user:id,first_name,last_name,email,updated_at',
                    'rating:recipe_id,rating'
            ])
            ->select('id', 'user_id', 'title', 'description', 'url', 'updated_at')
            ->find($existedrand);
        foreach($recipeModelGet as &$item){
            if(count($item->rating) > 0){
                $item['rate'] = Commons::sortRatings($item->rating);
            }
            else{
                $item['rate'] = ['count' => 0, 'rating' => 0];
            }
        }
        return $recipeModelGet;
    }
    
    public static function featuredRecipe(){
        $unsorted;
        $userModel = Recipe::with(
            'rating:recipe_id,rating',
            'user:id,first_name,last_name'
            )
            ->select(['id', 'user_id', 'title', 'description', 'url', 'created_at'])
            ->get();
        foreach($userModel as &$items){
            if(count($items->rating) > 0){
                $items['rate'] = Commons::sortRatings($items->rating);
            }
            else{
                $items['rate'] = ['count' => 0, 'rating' => 0];
            }
        }
        $sorted = array_slice(Commons::sortThis($userModel->toarray()), 0, 9);
        return $sorted;
    }
    
    public function createRecipes(Request $request){
        $request->validate(Recipe::createRecipeValidation());
        $uploadedFile = $request->file('profile_pic');
        $uploadedFile->store('public/recipemain'); 
        $url = 'storage/recipemain/' . $uploadedFile->hashName();
        $request->merge([
                'title' => ucwords($request->input('title')),
                'description' => ucfirst($request->input('description')),
                'user_id' => Auth::id(),
                'url' => $url,
            ]
        );
        $createResult = Recipe::create($request->all());
        if($createResult){
            $initMoreInfo = [
                'recipe_id' => $createResult->id,
                'duration' => '',
                'good_for' => '',
                'difficulty' => '',
                'budget' => '',
            ];
            RecipeMoreInfo::create($initMoreInfo);
            return redirect()->route('Main.viewRecipe', $createResult->id);
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
        $model->title = ucwords($request->input('title'));
        $model->save();
    }

    public function description($model, $request){
        $request->validate(['hidden' => 'required', 'description' => 'required']);
        $model->description = ucfirst($request->input('description'));
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
        $request->validate(['hidden' => 'required','recipemain' => 'required|mimes:jpg,jpeg,png',]);
        $img = $request->input('original_url');
        $uploadedFile = $request->file('recipemain'); 
        $url = 'storage/recipemain/' . $uploadedFile->hashName();
        Commons::userPictures($img, $request, $url);
        $recipeModel = Recipe::find($request->input('recipe_id'));
        $recipeModel->url = $url;
        $recipeModel->save();
    } 

    public function subImg($model, $request, $id){
        $request->validate(['hidden' => 'required', 'recipesub' => 'required|mimes:jpg,jpeg,png',]);
        $img = $request->input('original_url');
        $uploadedFile = $request->file('recipesub'); 
        $url = 'storage/recipesub/' . $uploadedFile->hashName();
        $request['url'] = $url;
        Commons::userPictures($img, $request, $url);
        $data = Recipe::with('subPictures:id,recipe_id,url')->select('id')->find($id);
        if(count($data['subPictures']) < 4){
            RecipePicture::create($request->all());
        }
        else{
            if(RecipePicture::where('url', $img)->exists()){
                RecipePicture::where('url', $img)->update(['url' => $url]);
            }
        } 
    }
    
    public function delete($id){
        $model = Recipe::with('subPictures:recipe_id,url')
            ->select('id','url')
            ->find($id);

        foreach($model['subPictures'] as $item){
            $newString = str_replace("storage", "public", $item['url']);
            Storage::delete($newString);
        }
        $newString = str_replace("storage", "public", $model['url']);
        Storage::delete($newString);
        $model->delete();
        return redirect()->route('Main.profile', Auth::id());
    }
    /* 
    |   End of use for edit method
    */
}
