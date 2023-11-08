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

use App\Http\Controllers\Mains;
use App\Http\Controllers\Users;
use App\Http\Controllers\Recipes;

/* 
| Docu: Mains controller for views return
*/
Route::get('/', [Mains::class, 'index'])->name('Main.index');
Route::get('/create/recipe', [Mains::class, 'recipeUserInput'])->name('Main.recipeUserInput');

/* 
| Docu: Users controller for user related process
*/
Route::post('/register/user', [Users::class, 'registerUser'])->name('Users.registerUser');
Route::post('/login/user', [Users::class, 'loginUser'])->name('Users.loginUser');
Route::get('/logout/user', [Users::class, 'logoutUser'])->name('Users.logoutUser');

/* 
| Docu: Recipes controller for recipes related process
*/
Route::post('/create/new/recipe', [Recipes::class, 'createRecipes'])->name('Recipes.createRecipes');
