@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
@if(Auth::id() === $user_data['id'])
    @include('layouts.edit-profile')
@endif
<div class="container custom-minvh-100">
    <div class="container">
        <div class="row overflow-hidden m-auto p-0 position-relative">
            <img class="img-fluid" src="{{ asset($img['cover_url']) }}" alt="cover" />
            <a href="#" class="upload-recipe-button w-25 text-center text-dark" data-bs-toggle="modal" data-bs-target="#edit-cover-modal">Upload</a>
        </div>
        <div class="container container-fluid position-relative">
            <img id="profile-picture" src="{{ asset($img['profile_url']) }}" alt="profile" />
            <div id="edit-profile-link" class="d-flex justify-content-end align-items-center">
                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-profile-modal">
                    @include('layouts.edit-button')
                </a>
            </div>
            <h1 class="m-0">
                {{ $user_data['first_name'] }}
                {{ $user_data['last_name'] }}
                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-name-modal">
                    @include('layouts.edit-button')
                </a>
            </h1>
            <small class="custom-reply d-block">
                Location:
                {{($more_info)?$more_info['location']:''}}
                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-location-modal">
                    @include('layouts.edit-button')
                </a>
            </small>
            <small class="custom-reply d-block">
                Email: {{ $user_data['email'] }}
                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-email-modal">
                    @include('layouts.edit-button')
                </a>
            </small>
            <small class="custom-reply d-block">
                Member since: {{ $user_data['created_at'] }}
            </small>
            <small class="custom-reply d-block mb-3">Recipes contributed: 15</small>
            <h2>
                About me
                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-aboutMe-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                </a>
            </h2>
            <p>
                {{ $more_info['about_me'] }}
            </p>
        </div>
    <div>
    <div class="container container-fluid">
        <h2 class="mb-4">Recipes</h2>
        <div id="profile-recipes" class="container row d-flex mb-5">
        @foreach($recipe as $item)
            <div class="card col-3 m-auto mb-3" style="width: 18rem;">
                <a href="{{ route('Main.viewRecipe', $item['id']) }}">
                    <img src="{{ asset($item['url']) }}" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <p class="card-text">
                        {{ $item['description'] }}
                    </p>
                </div>
                <div>
                    @include('layouts.stars-rating')
                    @include('layouts.person-heart')
                </div>
                <div class="card-footer row">
                    <a href="{{ route('Main.viewRecipe', $item['id']) }}" type="button" class="btn btn-primary col-5 m-auto">Edit</a>
                    <form class="col-5 p-0 m-auto" action="{{ route('Recipes.delete', $item['id']) }}" method="POST" >
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-danger col-12 m-auto" value="Delete"></input>
                    </form>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
