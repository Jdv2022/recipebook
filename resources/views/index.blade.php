@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
<div id="custom-background-1" class="custom-container-height">
    <div class="container p-5">
    @foreach($recipes as $recipes)    
        <div class="card-group">
        @foreach($recipes as $item)
            <div class="card m-3 border border-0">
                <img src="{{ asset($item['url']) }}" class="card-img-top" alt="...">
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
<div class="custom-container-height">
    <div class="container">
        <div class="container row m-3">
            <div class="container col-9">
                <h2>Name</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In hendrerit gravida rutrum quisque non. Blandit turpis cursus in hac.</p>
            </div>
            <div class="container col-2 rounded-circle">
                <img src="" alt="Profile Picture" />
            </div>
        </div>
        <div class="container row m-3">
            <div class="container col-2 rounded-circle">
                <img src="" alt="Profile Picture" />
            </div>
            <div class="container col-9">
                <h2>Name</h2>  
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Est ante in nibh mauris cursus mattis molestie a.</p>
            </div>
        </div>
        <div class="container row m-3">
            <div class="container col-9">
                <h2>Name</h2>  
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Est ante in nibh mauris cursus mattis molestie a.</p>
            </div>
            <div class="container col-2 rounded-circle">
                <img src="" alt="Profile Picture" />
            </div>
        </div>
        <div class="container row m-3">
            <div class="container col-2 rounded-circle">
                <img src="" alt="Profile Picture" />
            </div>
            <div class="container col-9">
                <h2>Name</h2>  
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Est ante in nibh mauris cursus mattis molestie a.</p>
            </div>
        </div>
        <div class="container row m-3">
            <div class="container col-9">
                <h2>Name</h2>  
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Est ante in nibh mauris cursus mattis molestie a.</p>
            </div>
            <div class="container col-2 rounded-circle">
                <img src="" alt="Profile Picture" />
            </div>
        </div>
    </div>
</div>
<div class="custom-container-height">
    <div class="container">
        <div class="d-flex justify-content-around">
            <div class="card mb-3 d-inline-block" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="..." class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3 d-inline-block" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="..." class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-around">
            <div class="card mb-3 d-inline-block" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="..." class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3 d-inline-block" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="..." class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-around">
            <div class="card mb-3 d-inline-block" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="..." class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3 d-inline-block" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="..." class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
