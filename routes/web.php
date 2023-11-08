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

/* 
| Docu: Mains controller for views return
*/
Route::get('/', [Mains::class, 'index'])->name('Main.index');

/* 
| Docu: Users model for user related process
*/
Route::post('/register/user', [Users::class, 'registerUser'])->name('Users.registerUser');
Route::post('/login/user', [Users::class, 'loginUser'])->name('Users.loginUser');
