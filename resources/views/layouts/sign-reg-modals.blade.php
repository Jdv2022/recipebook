<div class="modal fade" id="registration-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Registration</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            @if (session('register_error'))
                <span class="text-danger m-0 custom-small">{{ session('register_error') }}</span>
            @endif
                <form action="{{ route('Users.registerUser') }}" method="POST" id="register-form" enctype="multipart/form-data">
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
