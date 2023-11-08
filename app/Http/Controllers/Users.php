<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
/* 
| Docu: handles all users processes (validation, insert and Auth)
*/
class Users extends Controller{
    
    public function registerUser(Request $request){
        $model = new User;
        $validation = $request->validate($model->registrationValidation());
        $model->first_name = $request->input('first_name');
        $model->last_name = $request->input('last_name');
        $model->email = $request->input('email');
        $model->password = hash::make($request->input('password'));
        if($model->save()){
            return redirect()->back()->with('registered', 'Saved! Please login');
        }
        return redirect()->back()->with('register_error', 'System busy, please try again later');
    }
    
    public function loginUser(Request $request){
        $model = new User;
        $validation = $request->validate($model->loginValidation());
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->back();
        }
        return redirect()->back()->with('login-error', "System busy, please try again later");
    }

}
