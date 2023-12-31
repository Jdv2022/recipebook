<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* 
|   Docu: Mains controller for views return
*/
use App\Http\Controllers\Mains;
Route::get('/', [Mains::class, 'index'])->name('Main.index');
Route::get('/create/recipe', [Mains::class, 'recipeUserInput'])->name('Main.recipeUserInput')->middleware('auth');
Route::get('/show/recipe/{id}', [Mains::class, 'viewRecipe'])->name('Main.viewRecipe');
Route::get('/show/profile/{id}', [Mains::class, 'profile'])->name('Main.profile');
Route::get('/search/result', [Mains::class, 'search'])->name('Main.search');
/* 
|   Docu: Users controller for user related process
*/
use App\Http\Controllers\Users;
Route::post('/register/user', [Users::class, 'registerUser'])->name('Users.registerUser');
Route::post('/login/user', [Users::class, 'loginUser'])->name('Users.loginUser');
Route::get('/logout/user', [Users::class, 'logoutUser'])->name('Users.logoutUser');
Route::patch('/edit/user', [Users::class, 'edit'])->name('Users.edit');
/* 
|   Docu: Recipes controller for recipes related process
*/
use App\Http\Controllers\Recipes;
Route::post('/create/new/recipe', [Recipes::class, 'createRecipes'])->name('Recipes.createRecipes');
Route::patch('/edit/title/{id}', [Recipes::class, 'edit'])->name('Recipes.edit');
Route::delete('/delete/recipe/{id}', [Recipes::class, 'delete'])->name('Recipes.delete');
/* 
|   Docu: Comments controller
*/
use App\Http\Controllers\Comments;
Route::post('/post/comment', [Comments::class, 'create'])->name('Comments.create');
/* 
|   Docu: Review replies
*/
use App\Http\Controllers\Replies;
Route::post('/comment/reply', [Replies::class, 'create'])->name('Replies.create');
/* 
|   Docu: Rating controller
*/
use App\Http\Controllers\Ratings;
Route::post('/rating/create', [Ratings::class, 'create'])->name('Ratings.create');
/* 
|   Docu: For Ajax function
*/
use App\Http\Controllers\Ajax;
Route::get('/ajax/request/review/{id}', [Ajax::class, 'review'])->name('Ajax.review');
Route::get('/ajax/request/rating/{id}', [Ajax::class, 'rating'])->name('Ajax.rating');
