@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
<div class="container custom-minvh-100 mb-5">
    <h1 class="mt-4 mb-5">Search Results</h1>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
        @if(count($result) != 0)
        @php
            $n_color = 0;
        @endphp
        @foreach($result as $item)
        @php
        if($n_color > 2){
            $n_color = 0;
        }
        @endphp
            <div class="col">
                <div class="card">
                @if(isset($item['url']))
                    <a href="{{ route('Main.viewRecipe', $item['id']) }}">
                        <img src="{{ asset($item['url']) }}" class="card-img-top custom-height-300" alt="Responsive Image">
                    </a>
                @else
                    <a href="{{ route('Main.viewRecipe', $item['id']) }}">
                        <img class="card-img-top" src="{{ asset('img/sub.png') }}" alt="Dish">
                    </a>
                @endif 
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $item['title'] }}
                        </h5>
                        <small class="custom-reply">
                            By:
                            <a class="text-decoration-none custom-reply" href="{{ route('Main.profile', $item['owner']['user_id']) }}">
                                {{ $item['owner']['first_name'] }} {{ $item['owner']['last_name'] }}
                            </a>
                        </small>
                        <p class="card-text custom-height-profile-rep-pic">
                            {{ $item['description'] }}
                        </p>
                        <div>
                            @include('layouts.group-rate')
                            @include('layouts.group-heart')
                        </div>
                    </div>
                @if($n_color == 0)
                    <div class="card-footer foot-green"></div>
                @elseif($n_color == 1)
                    <div class="card-footer foot-yellow"></div>
                @else 
                    <div class="card-footer foor-violet"></div>
                @endif
                </div>
            </div>
         @php
            $n_color += 1; 
        @endphp
        @endforeach
        @else
        <h2 class="text-center m-auto mt-5">We dont have that, sorry!</h2>
        @endif
        </div>
    </div>
<div>
@endsection
