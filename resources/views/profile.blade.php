@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
<div class="container">
    <div class="container">
        <div class="container cnotainer-fluid p-2 pl-3">
            <small>Profile visitors: 3</small>
        </div>
        <div class="row overflow-hidden m-auto p-0">
            <img class="img-fluid" src="{{ asset('storage\user\MPY6vaVQG8Pu07g7O0aRSKGvvQ5ZoQmMBa3UUoM2.png') }}" alt="cover" />
        </div>
        <div class="container container-fluid position-relative">
            <img id="profile-picture" src="{{ asset('storage\user\MPY6vaVQG8Pu07g7O0aRSKGvvQ5ZoQmMBa3UUoM2.png') }}" alt="profile" />
            <div id="edit-profile-link" class="d-flex justify-content-end align-items-center">
                <a href="">Edit Profile</a>
            </div>
            <h1 class="m-0">John Dennis Vistal</h1>
            <small class="custom-reply d-block">Bohol, Central Visayas, Philippines</small>
            <small class="custom-reply d-block">Email: jhondennisvistal@gmail.com</small>
            <small class="custom-reply d-block mb-3">Recipes contributed: 15</small>
            <h2>About me</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Enim lobortis scelerisque fermentum dui faucibus in. Libero justo laoreet sit amet. In hendrerit gravida rutrum quisque non tellus.</p>
        </div>
    <div>
    <div class="container container-fluid">
        <h2 class="mb-4">Recipes</h2>
        <div id="profile-recipes" class="container row d-flex mb-5">
            <div class="card col-3 m-auto mb-3" style="width: 18rem;">
                <img src="{{ asset('storage\user\MPY6vaVQG8Pu07g7O0aRSKGvvQ5ZoQmMBa3UUoM2.png') }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div>
                @for($i=0; $i < 5; $i++)
                    <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                        <polygon points="50,10 61.8,37.6 90,37.6 66.2,54.4 78.4,81 50,64.2 21.6,81 33.8,54.4 10,37.6 38.2,37.6" fill="orange" stroke="orange" stroke-width="3px" />
                    </svg> 
                @endfor
                </div>
                <div class="card-footer row">
                    <a href="#" type="button" class="btn btn-primary col-5 m-auto">Edit</a>
                    <button type="button" class="btn btn-danger col-5 m-auto">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
