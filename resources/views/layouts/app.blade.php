<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <style>
        .log-in{
            margin-right: 30px;
        }
        .custom-small{
            font-size: .8rem;
        }
    </style>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: #e3f2fd;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Recipe Book</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                @if (auth()->check())
                <a class="btn btn-light log-in" data-bs-toggle="modal" data-bs-target="#logout-modal">Log out</a>
                @else
                <a class="btn btn-light log-in" data-bs-toggle="modal" data-bs-target="#login-modal">Log in</a>
                @endif
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#registration-modal">Create an Account</button>
                </div>
            </div>
        </nav>
        <main>
            <div class="modal fade" id="registration-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Registration</h1>
                        @if (session('register_error'))
                            <span class="text-danger m-0 custom-small">{{ session('register_error') }}</span>
                        @endif
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('Users.registerUser') }}" method="POST" id="register-form">
                                @csrf
                                <input type="hidden" name="hidden" value="register-modal">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First name</label>
                                    <input type="email" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}">
                                @error('first_name')
                                    <span class="text-danger m-0 custom-small">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last name</label>
                                    <input type="email" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}">
                                @error('last_name')
                                    <span class="text-danger m-0 custom-small">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger m-0 custom-small">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                                @error('password')
                                    <span class="text-danger m-0 custom-small">{{ $message }}</span>
                                @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submit-registration">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="login-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        @if (session('registered'))
                            <p class="alert alert-success">{{ session('registered') }}</p>
                        @endif
                        @if (session('login-error'))
                            <p class="alert alert-danger">{{ session('login-error') }}</p>
                        @endif
                        <div class="modal-body">
                            <form action="{{ route('Users.loginUser') }}" method="POST" id="login-form">
                                @csrf
                                <input type="hidden" name="hidden" value="login-modal">
                                <div class="mb-3">
                                    <label for="email-login" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email-login" aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger m-0 custom-small">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password-login" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password-login" name="password" value="{{ old('password') }}">
                                 @error('password')
                                    <span class="text-danger m-0 custom-small">{{ $message }}</span>
                                @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submit-login">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to log out?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yes</button>
                            <button type="submit" class="btn btn-primary" id="submit-login">No</button>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </main>
    </body>
    <script>
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
    </script>
</html>
