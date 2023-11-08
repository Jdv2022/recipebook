@extends('layouts.app')

@section('title', 'Generate Recipe Book')

@section('content')
<div class="modal-body">
    <form action="{{ route('Users.registerUser') }}" method="POST" id="register-form" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="number_of_ingredients" class="form-label">How many ingredients?</label>
            <input type="text" class="form-control" id="number_of_ingredients" aria-describedby="emailHelp" name="number_of_ingredients" value="{{ old('number_of_ingredients') }}">
        @error('number_of_ingredients')
            <span class="text-danger m-0 custom-small">{{ $message }}</span>
        @enderror
        </div>
        <div class="mb-3">
            <label for="instructions" class="form-label">Instructions</label>
            <input type="text" class="form-control" id="instructions" name="instructions" value="{{ old('instructions') }}">
        @error('password')
            <span class="text-danger m-0 custom-small">{{ $message }}</span>
        @enderror
        </div>
        <div class="mb-3">
            <label for="formFileSm" class="form-label">Upload dish picture</label>
            <input class="form-control form-control-sm" id="formFileSm" type="file" name="food_picture">
        @error('food_picture')
            <span class="text-danger m-0 custom-small">{{ $message }}</span>
        @enderror
        </div>
    </form>
</div>
@endsection
