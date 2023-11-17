@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
<div id="custom-background-1" class="custom-container-height common_img">
    <div class="container p-5">
        <h2 class="mb-5">Latest Recipes</h2>
        <div class="row row-cols-1 row-cols-md-4     g-4">
        @foreach($latest_section as $item)
            <div class="col">
                <div class="card">
                    <a href="{{ route('Main.viewRecipe', $item->id) }}">
                        <img src="{{ $item->url }}" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title text-wrap-balance">
                            {{ $item->title }}
                            <p>
                                <a class="custom-reply" href="{{ route('Main.profile', $item->user->id) }}">
                                    By: {{ $item->user->first_name }} {{ $item->user->last_name }}
                                </a>
                            </p>
                        </h5>
                        <div class="truncated-text">
                            <p class="card-text text-flow truncate-text">
                                {{ $item->description }}
                            </p>
                        </div>
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
                                {{ $item->time  }}
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection
