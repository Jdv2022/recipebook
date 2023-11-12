@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
<div class="container pb-5 d-flex justify-content-center align-items-center">
    <div class="container row mt-5 m-auto">
        <div class="container col-md-6 m-auto col-sm-12">
            <img id="prev-main-img" class="col-12" src="{{ asset($main_img) }}" alt="Dish">
            <div class="row">
                <div class="col-3 pt-1 pb-1">
                    <img class="img-fluid recipe-imgs" src="{{ asset('storage\user\MPY6vaVQG8Pu07g7O0aRSKGvvQ5ZoQmMBa3UUoM2.png') }}" alt="Dish">
                </div>
                <div class="col-3 pt-1 pb-1">
                    <img class="img-fluid recipe-imgs" src="{{ asset('storage\user\FYz2afi51tS8ccKh3GiElqA18sIGLTIQEKY9QpDB.png') }}" alt="Dish">
                </div>
                <div class="col-3 pt-1 pb-1">
                    <img class="img-fluid recipe-imgs" src="{{ asset('storage\user\YJ7SY1kan60FdRuYoUgEOjeyOM8jTH0vVLM7EMH4.png') }}" alt="Dish">
                </div>
                <div class="col-3 pt-1 pb-1">
                    <img class="img-fluid recipe-imgs" src="{{ asset('storage\user\X2HTQD3pwArFMR9jY9eR9yo8ZbbWupVkNvJkyJ4h.png') }}" alt="Dish">
                </div>
            </div>
        </div>
        <div class="container col-md-5 h-100 col-sm-12">
            <h1 class="m-0 violet">{{ $data['title'] }}</h1>
            <small class="custom-reply d-block">By {{ $user_data['first_name'] }} {{ $user_data['last_name'] }}</small>
            <div class="mt-3 mb-3">
            @php
                $count = $ave_rating;
            @endphp
            @for($i = 1; $i <= 5; $i++)
            @if($count >= 1)
                <svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                    <polygon points="50,10 61.8,37.6 90,37.6 66.2,54.4 78.4,81 50,64.2 21.6,81 33.8,54.4 10,37.6 38.2,37.6" fill="orange" stroke="orange" stroke-width="10px" />
                </svg> 
            @elseif($count < 1 && $count > 0)
                <svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                    <polygon points="50,10 61.8,37.6 90,37.6 66.2,54.4 78.4,81 50,64.2 21.6,81 33.8,54.4 10,37.6 40,37.6" fill="white" stroke="orange" stroke-width="10px" />
                    <polygon points="50,10 50,64.2 21.6,81 35,54.4 27,37.6" fill="orange" />
                </svg>
            @else
                <svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                    <polygon points="50,10 61.8,37.6 90,37.6 66.2,54.4 78.4,81 50,64.2 21.6,81 33.8,54.4 10,37.6 38.2,37.6" fill="white" stroke="orange" stroke-width="10px" />
                </svg> 
            @endif
            @php
                $count -= 1;
            @endphp
            @endfor
            </div>
            <h3>Description</h3>
            <p>{{ $data['description'] }}</p>
            <h3>Other Details</h3>
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
        <h2 class="mb-4">Ingredients</h2>
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
        <h2 class="mb-4">Method</h2>
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
        @for($i = 1; $i <= 5; $i++)
            <svg id="star{{ $i }}" data-check="false" data-recipe-id="{{ $data['id'] }}" data-value="{{ $i }}" class="m-2 star" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
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
