@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
<div id="custom-background-1" class="custom-container-height common_img">
    <div class="container p-5">
    @foreach($recipes as $recipes)    
        <div class="card-group">
        @foreach($recipes as $item)
            <div class="card m-3 border border-0">
                <a href="{{ route('Main.viewRecipe', $item['id']) }}">
                    <img src="{{ asset($item['url']) }}" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{{ $item['title'] }}</h5>
                    <p class="card-text">{{ $item['description'] }}</p>
                </div>
                <div class="card-footer border border-0 custom-nav-color">
                    <small class="text-black">Last updated {{ $item['time'] }}</small>
                </div>
            </div>
        @endforeach
        </div>
    @endforeach
    </div>
</div>
<div id="custom-background-2" class="custom-container-height common_img">
    <div class="container">
    @php
        $count = 0;
    @endphp
    @foreach($featured_user as $user)
        <div class="container row mb-3 p-3 rounded m-auto">
        @if($count%2==0)
            <div class="container col-9 custom-bg2-bgcolor-inner">
                <h2>{{ $user['first_name'] }} {{ $user['last_name'] }}</h2>
                <p>{{ $user['about_me'] }}</p>
                <div class="card-footer border border-0">
                    <small class="d-block">Education: {{ $user['education'] }}</small>
                    <small class="text-black">Member since: {{ $user['created_at'] }}</small>
                </div>
            </div>
            <div class="container col-2 d-flex justify-content-end">
                <img class="img_default" src="{{ asset('img/default_user.png') }}" alt="Profile Picture" />
            </div>
        @else
            <div class="container col-2 d-flex justify-content-start">
                <img class="img_default" src="{{ asset('img/default_user.png') }}" alt="Profile Picture" />
            </div>
            <div class="container col-9 custom-bg2-bgcolor-inner">
                <h2>{{ $user['first_name'] }} {{ $user['last_name'] }}</h2>
                <p>{{ $user['about_me'] }}</p>
                <div class="card-footer border border-0">
                    <small class="d-block">Education: {{ $user['education'] }}</small>
                    <small class="text-black">Member since: {{ $user['created_at'] }}</small>
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
<div id="custom-background-3" class="custom-container-height common_img">
    <div class="container">
    @foreach($featuredRecipes as $items)
        <div class="d-flex justify-content-around">
        @foreach($items as $item)
            <div class="card mb-3 d-inline-block" style="max-width: 540px;">
                <div class="row g-0">
                    <a class="col-md-4" href="{{ route('Main.viewRecipe', $item['id']) }}">
                        <img src="{{ asset($item['url']) }}" class="img-fluid rounded-start featured-dish" alt="Dish picture">
                    </a>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['title'] }}</h5>
                            <p class="card-text">{{ $item['description'] }}</p>
                            <p class="card-text"><small class="text-body-secondary">Rating:</small></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @endforeach
    </div>
</div>
@endsection
