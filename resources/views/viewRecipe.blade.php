@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
<div class="container pb-5">
    <div class="container container-fluid row mt-5">
        <img src="http://localhost:8000/img/bg1.png" class="container col-5 m-auto" alt="Dish">
        <div class="container col-5 h-100">
            <h1>{{ $data['title'] }}</h1>
            <h2>Rating</h2>
            <h3>Description</h3>
            <p>{{ $data['description'] }}</p>
            <h3>Other Details</h3>
            <p>Duration</p>
            <p>Good for</p>
            <p>Difficulty</p>
            <p>Budget</p>
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
        <h2 class="mb-4">Cooking Method</h2>
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
<div class="w-100 row p-5 m-auto border border-top-primary mt-5">
    <div class="container-sm col-6 text-center">
        <h2 class="m-0 p-0 mb-5 text-center">Ratings<h2>
        <ol class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-start custom-reviews align-items-center">
                <p class="mt-2 mb-2">5 Star</p>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start custom-reviews align-items-center">
                <p class="mt-2 mb-2">4 Star</p>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start custom-reviews align-items-center">
                <p class="mt-2 mb-2">3 Star</p>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start custom-reviews align-items-center">
                <p class="mt-2 mb-2">2 Star</p>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start custom-reviews align-items-center">
                <p class="mt-2 mb-2">1 Star</p>
                <span class="badge bg-primary rounded-pill">14</span>
            </li>
        </ol>
        <a class="btn btn-dark custom-nav-color border border-0 mt-5" data-bs-toggle="modal" data-bs-target="#logout-modal">Rate Recipe</a>
    </div>
    <div class="container-sm col-6 position-relative">
        <h2 class="m-0 p-0 mb-5 text-center">Customer Reviews<h2>
        <div id="comments-container" class="custom-reviewcontainer"></div>
        <form id="comments-form" class="input-group custom-comment-input p-1 pb-0">
            @csrf
            <input id="comment-input" name="comment-input" type="text" class="form-control" placeholder="{{ $errors->has('comment-input') ? $errors->first('comment-input') : 'Post a comment' }}" aria-label="Recipient's username" aria-describedby="button-addon2">
            <input class="btn btn-dark custom-nav-color text-light border border-0" type="submit" value="Post"/>
        </form>
    </div>
</div>
@endsection
