@extends('layouts.app')

@section('title', 'Recipe Book')

@section('content')
<div class="container-sm">
    <form action="{{ route('Recipes.createRecipes') }}" method="POST" id="register-form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="hidden" value="register-recipe">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        @error('title')
            <span class="text-danger m-0 custom-small">{{ $message }}</span>
        @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" value="{{ old('description') }}"></textarea>
        @error('description')
            <span class="text-danger m-0 custom-small">{{ $message }}</span>
        @enderror
        </div>
        <div class="mb-3">
            <label for="list_of_ingredients" class="form-label">List of Ingredients</label>
            <textarea class="form-control" id="list_of_ingredients" name="list_of_ingredients" value="{{ old('list_of_ingredients') }}"></textarea>
        @error('list_of_ingredients')
            <span class="text-danger m-0 custom-small">{{ $message }}</span>
        @enderror
            <div id="passwordHelpBlock" class="form-text">
                Put a '~' (approximately abbreviation) after each ingredients. 
            </div>
        </div>
        <div class="mb-3">
            <label for="instructions" class="form-label">Instructions</label>
            <textarea class="form-control" id="instructions" name="instructions" value="{{ old('instructions') }}"></textarea>
        @error('instructions')
            <span class="text-danger m-0 custom-small">{{ $message }}</span>
        @enderror
            <div id="passwordHelpBlock" class="form-text">
                Put a '~' (approximately abbreviation) after each step. 
            </div>
        </div>
        <div class="mb-3">
            <label for="formFileSm" class="form-label">Upload Main Dish Picture</label>
            <input class="form-control form-control-sm" id="formFileSm" type="file" name="food_picture">
        @error('food_picture')
            <span class="text-danger m-0 custom-small">{{ $message }}</span>
        @enderror
        </div>
        <div class="d-grid gap-2 col-6 mx-auto mb-3">
            <input type="submit" class="btn btn-primary " value="Create Recipe">
        </div>
    </form>
</div>
@endsection
