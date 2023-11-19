@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
@if(Auth::id() === $recipe_data['user']['id'])
    @include('layouts.edit-recipe-modal')
@endif
<div class="container pb-5 d-flex justify-content-center align-items-center">
    <div class="container row mt-5 m-auto">
        <div class="container col-md-6 m-auto col-sm-12 position-relative ">
            <div class="custom-height-300 d-flex align-items-center">
            @if($recipe_data['url'])
                <img id="prev-main-img" class="col-12" src="{{ asset($recipe_data['url']) }}" alt="Dish">
            @else
                <img class="img-fluid recipe-imgs m-auto" src="{{ asset('img/def-bg') }}" alt="Dish">
            @endif
            </div>
            @if(Auth::id() === $recipe_data['user']['id'])
                <a class="upload-recipe-button" href="" data-bs-toggle="modal" data-bs-target="#edit-mainImg-recipe-modal">Upload</a>
            @endif
            <div class="row">
                @include('layouts.sub-images')
            </div>
        </div>
        <div class="container col-md-5 h-100 col-sm-12">
            <h1 class="m-0 violet">
                {{ $recipe_data['title'] }} 
            @if(Auth::id() === $recipe_data['user']['id'])
                <a href="" data-bs-toggle="modal" data-bs-target="#edit-title-recipe-modal">
                    @include('layouts.edit-button')
                </a>
            @endif
            </h1>
            <small class="custom-reply d-block">
                By: 
                <a class="text-decoration-none custom-reply" href="{{ route('Main.profile', $recipe_data['id']) }}">
                    {{ $recipe_data['user']['first_name'] }} {{ $recipe_data['user']['last_name'] }}
                </a>
            </small>
            <div class="mt-3 mb-3">
       
            </div>
            <h3>
                Description
            @if(Auth::id() === $recipe_data['user']['id'])
                <a href="" data-bs-toggle="modal" data-bs-target="#edit-description-recipe-modal">
                    @include('layouts.edit-button')
                </a>
            @endif
            </h3>
            <p>{{ $recipe_data['description'] }}</p>
            <h3>
                Other Details
            @if(Auth::id() === $recipe_data['user']['id'])
                <a href="" data-bs-toggle="modal" data-bs-target="#edit-otherDetails-recipe-modal">
                    @include('layouts.edit-button')
                </a>
            @endif
            </h3>
            <p class="mb-1">Duration: <span class="custom-bold">{{ $recipe_data['moreInfo']['duration'] }}<span></p>
            <p class="mb-1">Good for: <span class="custom-bold">{{ $recipe_data['moreInfo']['good_for'] }}<span></p>
            <p class="mb-1">Difficulty: <span class="custom-bold">{{ $recipe_data['moreInfo']['difficulty'] }}<span></p>
            <p class="mb-1">Budget: <span class="custom-bold">{{ $recipe_data['moreInfo']['budget'] }}<span></p>
        </div>
    </div>
</div>
@php
    $count = 1;
@endphp
<div class="w-100 row m-auto overflow-x-hidden">
    <div class="container col-6 p-5">
        <h2 class="mb-4">
            Ingredients
        @if(Auth::id() === $recipe_data['user']['id'])
            <a href="" data-bs-toggle="modal" data-bs-target="#edit-ingredients-recipe-modal">
                @include('layouts.edit-button')
            </a>
        @endif
        </h2>
        <ul class="list-group">
        @foreach($recipe_data['list_of_ingredients_sorted'] as $item)
            <li class="list-group-item">
                <input class="form-check-input me-1" type="checkbox" value="">
                <label class="form-check-label">{{ $item }}</label>
            </li>
        @endforeach
        </ul>
    </div>
<div class="container col-6 p-5 custom-nuetral-bg-color overflow-x-hidden">
    <h2 class="mb-4">
        Method
    @if(Auth::id() === $recipe_data['user']['id'])
        <a href="" data-bs-toggle="modal" data-bs-target="#edit-method-recipe-modal">
            @include('layouts.edit-button')
        </a>
    @endif
    </h2>
    @foreach($recipe_data['instructions_sorted'] as $item)
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
            <input type="hidden" name="recipe_id" value="{{ $recipe_data['id'] }}" />
            <input id="comment-input" name="content" type="text" class="form-control" placeholder="{{ $errors->has('content') ? $errors->first('content') : 'Post a comment' }}" aria-label="Recipient's username" aria-describedby="button-addon2">
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
        @for($i = 1; $i <= 5; $i++)
            <svg class="m-2 star" data-value="{{ $i }}" data-recipe-id="{{ $recipe_data['id'] }}" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                <polygon points="50,10 61.8,37.6 90,37.6 66.2,54.4 78.4,81 50,64.2 21.6,81 33.8,54.4 10,37.6 38.2,37.6" fill="white" stroke="orange" stroke-width="10px" />
            </svg> 
        @endfor
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-rating" data-bs-dismiss="modal">Close</button>
            <button id="submit-rating" type="button" class="btn btn-primary">Submit Rating</button>
        </div>
        </div>
    </div>
</div>
@endsection
