@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
        <div id="custom-background-1" class="custom-container-height common_img pb-5 pt-3">
            <div class="container">
                <h1 class="mb-5">Recipes</h1>
                <div class="row row-cols-1 row-cols-md-4 g-4">
@foreach($latest_section as $item)
                    <div class="col">
                        <div class="card h-100">
                            <a href="{{ route('Main.viewRecipe', $item->id) }}" class="custom-height-200">
                                <img src="{{ $item->url }}" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title text-wrap-balance overflow-auto">
                                    {{ $item->title }}
                                    <p>
                                        <a class="custom-reply" href="{{ route('Main.profile', $item->user->id) }}">
                                            By: {{ $item['user']['first_name'] }} {{ $item['user']['last_name'] }}
                                        </a>
                                    </p>
                                </h5>
                                <div>
                                    <div class="d-flex align-items-center d-block mt-3 custom-padding-left-12px">
                                        @include('layouts.group-heart')
                                    </div>
                                    <div class="d-flex align-items-center d-block">
                                        @include('layouts.group-rate')
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer border border-0 custom-nav-color">
                                <small class="text-black">
                                    {{ $item['updated_at']->format('F j, Y')  }}
                                </small>
                            </div>
                        </div>
                    </div>
@endforeach
                </div>
            </div>
        </div>
        <div id="custom-background-2" class="custom-container-height common_img pb-5 pt-3 pt-5 pb-5">
        <div class="container p-0">
            <h1>Featured Users</h1>
@php
    $count = 0;
@endphp
@foreach($featured_user as $item)
            <div class="container d-flex mb-3 rounded m-auto p-0">
@if($count%2==0)
                <div class="container custom-bg2-bgcolor-inner w-100">
                    <h4>
                        <a class="text-decoration-none blue" href="{{ route('Main.profile', $item['id']) }}">{{ $item['first_name'] }}  {{ $item['last_name'] }}</a>
                    </h4>
                    <p class="about-me">{{ $item['more_user_info']['about_me'] }}</p>
                    <div class="card-footer border border-0">
                    <small class="text-black d-block">Total recipes contributed: {{ $item['total_recipes'] }}</small>
                        <small class="d-block">Location: {{ $item['more_user_info']['location'] }}</small>
                        <small class="text-black d-block">Member since: {{ $item['time'] }}</small>
                        <small class="text-black d-block">
                            @include('layouts.group-rate')
                            @include('layouts.group-heart')
                        </small>
                    </div>
                </div>
                <div class="container d-flex justify-content-end w-25 p-0">
                    <a class="p-0" href="{{ route('Main.profile', $item['id']) }}">
                        <img id="homepage-profile" class="img_default" src="{{ asset($item['user_picture']['profile_url']) }}" alt="Profile Picture" />
                    </a>
                </div>
@else
                <div class="container d-flex justify-content-start w-25 p-0">
                    <a href="{{ route('Main.profile', $item['id']) }}">
                        <img id="homepage-profile" class="img_default" src="{{ asset($item['user_picture']['profile_url']) }}" alt="Profile Picture" />
                    </a>
                </div>
                <div class="container custom-bg2-bgcolor-inner w-100">
                    <h4><a class="text-decoration-none blue" href="{{ route('Main.profile', $item['id']) }}">{{ $item['first_name'] }}  {{ $item['last_name'] }}</a></h4>
                    <p class="about-me">{{ $item['more_user_info']['about_me'] }}</p>
                    <div class="card-footer border border-0">
                        <small class="text-black d-block">Total recipes contributed: {{ $item['total_recipes'] }}</small>
                        <small class="d-block">Location: {{ $item['more_user_info']['location'] }}</small>
                        <small class="text-black d-block">Member since: {{ $item['time'] }}</small>
                        <small class="text-black d-block">
                            @include('layouts.group-rate')
                            @include('layouts.group-heart')
                        </small>
                    </div>
                </div>
@endif
            </div>
@php
    $count += 1;
@endphp
@endforeach
        </div>
    </div>
    <div id="custom-background-3" class="custom-container-height common_img pb-5 pt-3 pt-5 pb-5">
        <div class="container">
            <h1>Featured Recipes</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
@foreach($featured_recipes as $item)
                <div class="col">
                    <div class="card mb-3 custom-bg2-bgcolor-inner" style="max-width: 540px;">
                        <div class="row g-0">
                            <a href="{{ route('Main.viewRecipe', $item['id']) }}" class="custom-nuetral-bg-color col-md-4 overflow-hidden d-flex align-items-center">
@if($item['url'])
                                <img src="{{ asset($item['url']) }}" class="img-fluid rounded-start h-100 m-auto" alt="...">
@else
                                <img class="img-fluid recipe-imgs m-auto" src="{{ asset('img/sub.png') }}" alt="Dish">
@endif
                            </a>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a class="text-decoration-none blue" href="{{ route('Main.viewRecipe', $item['id']) }}">
                                        <h5 class="card-title text-wrap-balance h-70">{{ $item['title'] }}</h5>
                                        <a class="custom-reply" href="{{ route('Main.profile', $item['id']) }}">
                                            By: {{ $item['user']['first_name'] }} {{ $item['user']['last_name'] }}
                                        </a>
                                    </a>
                                    <p class="card-text">
                                        <small class="text-body-secondary">
                                            @include('layouts.group-heart')
                                        </small>
                                        <div>
                                            @include('layouts.group-rate')
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endforeach
            </div>
        </div>
    </div>
@endsection
