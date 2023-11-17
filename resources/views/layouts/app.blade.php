<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg position-sticky top-0 sticky-top custom-nav-color">
            <div class="container-fluid">
                <a class="navbar-brand text-bold" href="{{ route('Main.index') }}">Recipe Book</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <form action="{{ route('Main.search') }}" method="GET" class="d-flex custom-margin-left" role="search">
                        <input class="form-control m-0 custom-search" type="search" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-light custom-nav-color custom-buttom-search" type="submit">Search</button>
                    </form>
                    <a class="btn btn-dark log-in custom-nav-color border border-0 " href="{{ route('Main.recipeUserInput') }}">Add Recipe</a>
                @if (auth()->check())
                    <a href="{{ route('Main.profile', Auth::id()) }}" class="btn btn-dark log-in custom-nav-color border border-0">My Profile</a>
                    <a class="btn btn-dark log-in custom-nav-color border border-0" data-bs-toggle="modal" data-bs-target="#logout-modal">Log out</a>
                @else
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
        /* 
        |   Docu: Home page form submission and modal loading
        */
        $("#submit-registration").click(function() {
            $('#register-form').submit();
        });
        $("#submit-login").click(function() {
            $('#login-form').submit();
        });
        $("#submit-logout").click(function() {
            $('#logout-modal').modal('show');
        });
        @if(old('hidden') === "register-modal" || session('register_error'))
            $(document).ready(function() {
                $('#registration-modal').modal('show');
            });
        @endif
        @if(old('hidden') === "login-modal" || session('registered') || session('login-error'))
            $(document).ready(function() {
                $('#login-modal').modal('show');
            });
        @endif
        /* 
        |   Docu: AJAX for comment and replies section
        */
        $.ajax({
            type: 'GET',
            url: "{{ route('Ajax.review') }}", 
            success: function(response) {
                $('#comments-container').html(response);
            },
        });
        $('#comments-form').submit(function(e) {
            e.preventDefault(); 
            const formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('Comments.create') }}", 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(response) {
                    $('#comment-input').val('');
                    $('#comments-container').html(response);
                },
            });
        });
        $('#comments-container').on('submit','#reply-form',function(e) {
            e.preventDefault(); 
            const formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('Replies.create') }}", 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(response) {
                    $('#comment-reply').val('');
                    $('#comments-container').html(response);
                },
            });
        });
        /* 
        |   Star Review
        */
        $.ajax({
            type: 'GET',
            url: "{{ route('Ajax.rating') }}", 
            success: function(response) {
                $('#ratings-container').html(response);
            },
        });
        $('.star').click(function(e) {
            $('.star').css('background-color', 'white');
            $('.star').attr('data-check', "false");
            $(this).attr('data-check', "true");
            const dataIdValue = $(this).attr('data-value') - 1;
            $('.star').each(function(index, element) {
                if (index <= dataIdValue) {
                    $(element).css('background-color', 'orange');
                }
            });
        });
        $('.close-rating').click(function(){
            $('.star').css('background-color', 'white');
        })
        $('#submit-rating').click(function(event){
            $('.star').each(function(index, element) {
                if($(element).attr('data-check') === "true"){
                    recipe_id = $(element).attr('data-recipe-id')
                    rating = $(element).attr('data-value')
                    $('.close-rating').click()
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('Ratings.create') }}", 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {'recipe_id' : recipe_id, 'rating' : rating},
                        success: function(response) {
                            $('#ratings-container').html(response);
                        },
                    }); 
                }
            });
        }); 
        /* 
        |   This for image in preview. HOVER effect
        */
        const imgRecipeURL = $("#prev-main-img").attr('src');
        $(".recipe-imgs").mouseover(function () {
            $(this).css('opacity', '.5');
            $("#prev-main-img").attr("src", $(this).attr('src'));
        });
        $(".recipe-imgs").mouseout(function () {
            $(this).css('opacity', '1');
            $("#prev-main-img").attr("src", imgRecipeURL);
        });
        /* 
        | Edits modals
        */
        @if(old('hidden') === "edit-title-modal")
            $(document).ready(function() {
                $('#edit-title-recipe-modal').modal('show');
            });
        @endif
        @if(old('hidden') === "edit-description-modal")
            $(document).ready(function() {
                $('#edit-description-recipe-modal').modal('show');
            });
        @endif
        @if(old('hidden') === "edit-otherDetails-modal")
            $(document).ready(function() {
                $('#edit-otherDetails-recipe-modal').modal('show');
            });
        @endif
        @if(old('hidden') === "edit-ingredients-modal")
            $(document).ready(function() {
                $('#edit-ingredients-recipe-modal').modal('show');
            });
        @endif
        @if(old('hidden') === "edit-method-modal")
            $(document).ready(function() {
                $('#edit-method-recipe-modal').modal('show');
            });
        @endif
        @if(old('hidden') === "main_recipeImg_modal")
            $(document).ready(function() {
                $('#edit-mainImg-recipe-modal').modal('show');
            });
        @endif
        $(".upload-recipe-button").click(function () {
            const dataSubValue = $(this).attr('data-sub');
            $('#hidden-sub-pics').attr('value', dataSubValue)
            $('#edit-sub-recipe-modal').modal('show');
        });
        /* 
        |   Edit profile
        */
        @if(old('hidden') === "cover_modal")
            $(document).ready(function() {
                $('#edit-cover-modal').modal('show');
            });
        @endif
        @if(old('hidden') === "profile_modal")
            $(document).ready(function() {
                $('#edit-profile-modal').modal('show');
            });
        @endif
        @if(old('hidden') === "edit-profileName-modal")
            $(document).ready(function() {
                $('#edit-name-modal').modal('show');
            });
        @endif
        @if(old('hidden') === "edit-location-modal")
            $(document).ready(function() {
                $('#edit-location-modal').modal('show');
            });
        @endif
        @if(old('hidden') === "edit-email-modal")
            $(document).ready(function() {
                $('#edit-email-modal').modal('show');
            });
        @endif
        @if(old('hidden') === "edit-aboutMe-modal")
            $(document).ready(function() {
                $('#edit-aboutMe-modal').modal('show');
            });
        @endif
        /* 
        |   For long texts see more
        */
        $('.truncate-text').each(function(){
            const text = $(this).text();
            if(text.length > 220){
                $(this).text(text.substring(0, 220) + ' ' + '...');
            }
        })
    </script>
</html>
