@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
@if(Auth::id() === $user_data['id'])
    @include('layouts.edit-profile')
@endif
    <div class="container custom-minvh-100">
                    <div class="container">
                        <div class="row overflow-hidden m-auto p-0 position-relative">
                            <img class="img-fluid" src="{{ asset($user_data['userPicture']['cover_url']) }}" alt="cover" />
@if(Auth::id() === $user_data['id'])
                            <a href="#" class="upload-recipe-button w-25 text-center text-dark" data-bs-toggle="modal" data-bs-target="#edit-cover-modal">Upload</a>
@endif
                        </div>
                        <div class="container container-fluid position-relative">
                            <img id="profile-picture" src="{{ asset($user_data['userPicture']['profile_url']) }}" alt="profile" />
                            <div id="edit-profile-link" class="d-flex justify-content-end align-items-center">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-profile-modal">
@if(Auth::id() === $user_data['id'])
                                    @include('layouts.edit-button')
@endif
                                </a>
                            </div>
                            <h1 class="m-0">
                                {{ $user_data['first_name'] }}
                                {{ $user_data['last_name'] }}
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-name-modal">
@if(Auth::id() === $user_data['id'])
                                    @include('layouts.edit-button')
@endif
                                </a>
                            </h1>
                            <small class="custom-reply d-block">
                                Location:
                                {{ ($user_data)?$user_data['moreUserInfo']['location']:'' }}
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-location-modal">
@if(Auth::id() === $user_data['id'])
                                    @include('layouts.edit-button')
@endif
                                </a>
                            </small>
                            <small class="custom-reply d-block">
                                Email: {{ $user_data['email'] }}
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-email-modal">
@if(Auth::id() === $user_data['id'])
                                    @include('layouts.edit-button')
@endif
                                </a>
                            </small>
                            <small class="custom-reply d-block">
                                Member since: {{ $user_data['created_at']->format('F j, Y') }}
                            </small>
                            <small class="custom-reply d-block mb-3">Recipes contributed: {{ count($user_data['recipes']) }}</small>
                            <h2>
                                About me
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-aboutMe-modal">
@if(Auth::id() === $user_data['id'])
                                    @include('layouts.edit-button')
@endif
                                </a>
                            </h2>
                            <p>
                                {{ $user_data['moreUserInfo']['about_me'] }}
                            </p>
                        </div>
                    <div>
                <div class="container container-fluid">
                    <h2 class="mb-5">Recipes</h2>
                    <div id="profile-recipes" class="container row d-flex mb-5">
@foreach($user_data['recipes'] as $item)
                        <div class="card col-3 m-auto mb-3" style="width: 18rem;">
                            <a href="{{ route('Main.viewRecipe', $item['id']) }}" class="custom-height-profile-rep-pic">
                                <img src="{{ asset($item['url']) }}" class="card-img-top" alt="...">
                            </a>
                            <h5 class="card-title text-wrap-balance">
                                {{ $item['title'] }}
                            </h5>
                            <div class="card-body custom-height-profile-rep">
                                <p class="card-text">
                                    {{ $item['description'] }}
                                </p>
                            </div>
                            <div>
                                    @include('layouts.group-rate')
                                    @include('layouts.group-heart')
                                    
                            </div>
                            <div class="card-footer row foot-yellow mt-3">
@if(Auth::id() === $user_data['id'])
                                <a href="{{ route('Main.viewRecipe', $item['id']) }}" type="button" class="btn btn-primary col-5 m-auto">Edit</a>
                                <form class="col-5 p-0 m-auto" action="{{ route('Recipes.delete', $item['id']) }}" method="POST" >
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class="btn btn-danger col-12 m-auto" value="Delete"></input>
                                </form>
@else
                                {{ $item['created_at']->format('F j, Y') }}
@endif
                            </div>
                         </div>
 @endforeach
                    </div>
                </div>
            </div>
@endsection
