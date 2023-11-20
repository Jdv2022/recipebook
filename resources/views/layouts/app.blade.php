<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg position-sticky top-0 sticky-top custom-nav-color">
            <div class="container-fluid">
                <a class="navbar-brand text-bold" href="{{ route('Main.index') }}">Recipe Book</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end mt-3 mt-md-0" id="navbarSupportedContent">
                    <form action="{{ route('Main.search') }}" method="GET" class="d-flex custom-margin-left" role="search">
                        <input class="form-control m-0 custom-search" type="search" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-light custom-nav-color custom-buttom-search" type="submit">Search</button>
                    </form>
                @if (auth()->check())
                    <a class="btn btn-dark log-in custom-nav-color border border-0 " href="{{ route('Main.recipeUserInput') }}">Add Recipe</a>
                    <a href="{{ route('Main.profile', Auth::id()) }}" class="btn btn-dark log-in custom-nav-color border border-0">My Profile</a>
                    <a class="btn btn-dark log-in custom-nav-color border border-0" data-bs-toggle="modal" data-bs-target="#logout-modal">Log out</a>
                @else
                    <a class="btn btn-dark log-in custom-nav-color border border-0 " data-bs-toggle="modal" data-bs-target="#login-modal">Add Recipe</a>
                    <a class="btn btn-dark log-in custom-nav-color border border-0" data-bs-toggle="modal" data-bs-target="#login-modal">Log in</a>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#registration-modal">Create an Account</button>
                @endif
                </div>
            </div>
        </nav>
        <main>
        @if (auth()->check())
            <div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to log out?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <a href="{{ route('Users.logoutUser') }}" type="button" class="btn btn-primary col-5 m-auto" id="submit-login">Yes</a>
                            <button type="submit" class="btn btn-secondary col-5 m-auto" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @include('layouts.sign-reg-modals')
        @endif
            @yield('content')
        </main>
        <footer class="container-fluid text-center">
            <p class="m-0">© 2023 Project | johnden</p>
            <p class="m-0">Made with Bootstrap(UI) and Laravel(Fullstack)</p>
        </footer>
    </body>
    <script>
        const oldHidden = "{{ old('hidden') }}";
        const register_error = @json(session('register_error'));
        const registered = @json(session('registered'));
        const loginError = @json(session('login-error'));
    </script>
    <script src="{{ asset('js/profile.js') }}"></script>
    <script src="{{ asset('js/recipe.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/utility.js') }}"></script>
<!-- This is js for AJAX. Should only be loaded to views where it is needed. Will cause error if executed on otherviews -->
@if(isset($viewName) && $viewName === 'viewRecipe')
    <script>
        const ajaxRating = @json(route('Ajax.rating', ['id' => $recipe_data['id'] ?? null]));
        const ajaxReview = @json(route('Ajax.review', ['id' => $recipe_data['id'] ?? null]));
        const commentsCreate = "{{ route('Comments.create') }}";
        const repliesCreate = "{{ route('Replies.create') }}";
        const ratingCreate = "{{ route('Ratings.create') }}";
    </script>
    <script src="{{ asset('js/ajax.js') }}"></script>
@endif
</html>
