@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
@if(Auth::id() === $user_data['id'])
    @include('layouts.edit-recipe-modal')
@endif
<div class="container pb-5 d-flex justify-content-center align-items-center">
    <div class="container row mt-5 m-auto">
        <div class="container col-md-6 m-auto col-sm-12 position-relative ">
            <div class="custom-height-300 d-flex align-items-center">
            @if($data['url'])
                <img id="prev-main-img" class="col-12" src="{{ asset($data['url']) }}" alt="Dish">
            @else
                <img class="img-fluid recipe-imgs m-auto" src="{{ asset('img/def-bg.png') }}" alt="Dish">
            @endif
            </div>
            @if(Auth::id() === $user_data['id'])
                @include('layouts.edit-recipe-modal')
                <a class="upload-recipe-button" href="" data-bs-toggle="modal" data-bs-target="#edit-mainImg-recipe-modal">Upload</a>
            @endif
            <div class="row">
                @include('layouts.sub-images')
            </div>
        </div>
        <div class="container col-md-5 h-100 col-sm-12">
            <h1 class="m-0 violet">
                {{ $data['title'] }}
            @if(Auth::id() === $user_data['id'])
                <a href="" data-bs-toggle="modal" data-bs-target="#edit-title-recipe-modal">
                    @include('layouts.edit-button')
                </a>
            @endif
            </h1>
            <small class="custom-reply d-block">
                By 
                <a class="text-decoration-none custom-reply" href="{{ route('Main.profile', $user_data['id']) }}">
                    {{ $user_data['first_name'] }} {{ $user_data['last_name'] }}
                </a>
            </small>
            <div class="mt-3 mb-3">
                @include('layouts.stars-rating')
                @include('layouts.person-heart')
            </div>
            <h3>
                Description
            @if(Auth::id() === $user_data['id'])
                <a href="" data-bs-toggle="modal" data-bs-target="#edit-description-recipe-modal">
                    @include('layouts.edit-button')
                </a>
            @endif
            </h3>
            <p>{{ $data['description'] }}</p>
            <h3>
                Other Details
            @if(Auth::id() === $user_data['id'])
                <a href="" data-bs-toggle="modal" data-bs-target="#edit-otherDetails-recipe-modal">
                    @include('layouts.edit-button')
                </a>
            @endif
            </h3>
            <p class="mb-1">Duration: <span class="custom-bold">{{ $recipe_add_info['duration'] }}<span></p>
            <p class="mb-1">Good for: <span class="custom-bold">{{ $recipe_add_info['good_for'] }}<span></p>
            <p class="mb-1">Difficulty: <span class="custom-bold">{{ $recipe_add_info['difficulty'] }}<span></p>
            <p class="mb-1">Budget: <span class="custom-bold">{{ $recipe_add_info['budget'] }}<span></p>
        </div>
    </div>
</div>
@php
    $count = 1;
@endphp
<div class="w-100 row m-auto">
    <div class="container col-6 p-5">
        <h2 class="mb-4">
            Ingredients
        @if(Auth::id() === $user_data['id'])
            <a href="" data-bs-toggle="modal" data-bs-target="#edit-ingredients-recipe-modal">
                @include('layouts.edit-button')
            </a>
        @endif
        </h2>
        <ul class="list-group">
        @foreach($ingredients as $item)
            <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="">
                <label class="form-check-label">{{ $item }}</label>
            </li>
        @endforeach
        </ul>
    </div>
    <div class="container col-6 p-5 custom-nuetral-bg-color">
        <h2 class="mb-4">
            Method
        @if(Auth::id() === $user_data['id'])
            <a href="" data-bs-toggle="modal" data-bs-target="#edit-method-recipe-modal">
                @include('layouts.edit-button')
            </a>
        @endif
        </h2>
        @foreach($instruction as $item)
            <li class="list-group-item">
                <h3>Step {{ $count }}</h3>
                <p>{{ $item }}</p>
            </li>
@php
    $count += 1;
@endphp
        @endforeach
    </div>
</div>
<div class="w-100 row p-5 m-auto mt-5 custom-border-top-reviews">

    <!-- This is for AJAX in ratings -->
    <div id="ratings-container" class="container-sm col-md-6 col-sm-12 text-center pt-5"></div>

    <div class="container-sm position-relative col-md-6 col-sm-12 pt-5">
        <h2 class="m-0 p-0 mb-5 text-center">Customer Reviews<h2>

        <!-- This is for AJAX in Reviews -->
        <div id="comments-container" class="custom-reviewcontainer"></div> 

        <form id="comments-form" class="input-group custom-comment-input p-1 pb-0" style="z-index: 100;">
            @csrf
            <input id="comment-input" name="comment-input" type="text" class="form-control" placeholder="{{ $errors->has('comment-input') ? $errors->first('comment-input') : 'Post a comment' }}" aria-label="Recipient's username" aria-describedby="button-addon2">
            <input class="btn btn-dark custom-nav-color text-light border border-0" type="submit" value="Post"/>
        </form>
    </div>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Rate the Recipe!</h1>
            <button type="button" class="btn-close close-rating" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            @include('layouts.stars-rating')
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-rating" data-bs-dismiss="modal">Close</button>
            <button id="submit-rating" type="button" class="btn btn-primary">Submit Rating</button>
        </div>
        </div>
    </div>
</div>
@endsection
