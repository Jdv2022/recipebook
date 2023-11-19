<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserPicture;
use App\Models\UserAdditionalDetails;
use App\Helpers\Commons;

/* 
| Docu: handles all users processes (validation, insert and Auth)
*/
class Users extends Controller{
    /* 
    |   Docu: For user validation and creation. 
    */
    public function registerUser(Request $request){
        $model = new User;
        $newModel = new UserPicture;
        $userDet = new UserAdditionalDetails;
        $validation = $request->validate($model->registrationValidation());

        $model->first_name = $request->input('first_name');
        $model->last_name = $request->input('last_name');
        $model->email = $request->input('email');
        $model->password = hash::make($request->input('password'));

        if($model->save()){
            $newModel->user_id = $model->id;
            $newModel->profile_url = asset('img\default-user.png');
            $newModel->cover_url = asset('img\def-bg.png');
            $newModel->save();
            $userDet->user_id = $model->id;
            $userDet->about_me = "";
            $userDet->location = "";
            $userDet->save();
            return redirect()->back()->with('registered', 'Saved! Please login');
        }
        return redirect()->back()->with('register_error', 'System busy, please try again later')->withInput();
    }
    /* 
    |   Docu: User login validation and auth
    */
    public function loginUser(Request $request){
        $model = new User;
        $validation = $request->validate($model->loginValidation());

        $credentials = $request->only('email', 'password');
        
        if(Auth::attempt($credentials)){
            return redirect()->back();
        }
        return redirect()->back()->with('login-error', "Incorrect credentials");
    }
    
    public function logoutUser(){
        Auth::logout();
        return redirect()->route('Main.index');
    }

    /* 
    |   Docu: Serve as reverse proxy for edit recipes
    */
    public function edit(Request $request){
        $userModel = new User;
        $userId = Auth::id();
        $row = $userModel->find($userId);
        $selection = [
            'cover_modal' => 'updateCover',
            'profile_modal' => 'updateProfile',
            'edit-profileName-modal' => 'updateNames',
            'edit-location-modal' => 'location',
            'edit-email-modal' => 'email',
            'edit-aboutMe-modal' => 'aboutMe'
        ];

        foreach($selection as $key => $value){
            if($key === $request->input('hidden')){
                $this->{$value}($row, $request);
            }
        }

        return redirect()->route('Main.profile', $userId);
    }

    /* 
    |   Docu: edit functions
    */
    public function updateCover($model, $request){
        $commonMethods = new Commons;
        $request->validate([
            'cover' => 'required|mimes:jpg,jpeg,png',
            'hidden' => 'required',
        ]);
        $uploadedFile = $request->file('cover'); 
        $url = 'storage/cover/' . $uploadedFile->hashName();
        $commonMethods->userPictures($request->input('original_url'), $request, $url);
        $newModel = $model->userPicture;
        $newModel->cover_url = $url;
        $newModel->save();
    }

    public function updateProfile($model, $request){
        $commonMethods = new Commons;
        $request->validate([
            'profile' => 'required|mimes:jpg,jpeg,png',
            'hidden' => 'required',
        ]);
        $uploadedFile = $request->file('profile'); 
        $url = 'storage/profile/' . $uploadedFile->hashName();
        $commonMethods->userPictures($request->input('original_url'), $request, $url);
        $newModel = $model->userPicture;
        $newModel->profile_url = $url;
        $newModel->save();
    }

    public function updateNames($model, $request){
        $request->validate([
            'hidden' => 'required',
            'first_name' => 'required|min:2|max:45',
            'last_name' => 'required|min:2|max:45',
        ]);
        $model->first_name = $request->input('first_name');
        $model->last_name = $request->input('last_name');
        $model->save();
    }

    public function location($model, $request){
        $request->validate([
            'hidden' => 'required',
            'location' => 'required|max:50',
        ]);
        $row = $model->moreUserInfo;
        $row->location = $request->input('location');
        $row->save();
    }

    public function email($model, $request){
        $request->validate([
            'hidden' => 'required',
            'email' => 'required|email|max:50',
        ]);
        $row = $model->find(Auth::id());
        $row->email = $request->input('email');
        $row->save();
    }

    public function aboutMe($model, $request){
        $request->validate([
            'hidden' => 'required',
            'about_me' => 'required',
        ]);
        $row = $model->find(Auth::id());
        $infoModel = $row->moreUserInfo;
        $infoModel->about_me = $request->input('about_me');
        $infoModel->save();
    }
    /* 
    |   Doci: endd of edit functions
    */

}
