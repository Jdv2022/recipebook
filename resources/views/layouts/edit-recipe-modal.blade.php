<!-- Title edit form modal -->
<div class="modal fade" id="edit-title-recipe-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Recipe Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Recipes.edit', $recipe_data['id']) }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="hidden" value="edit-title-modal" />
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" aria-describedby="textHelp" value="{{ (old('title'))?old('title'):$recipe_data['title'] }}">
                    <div id="textHelp" class="form-text">Title must not be more than 45 letters.</div>
                    @error('title')
                        <span class="text-danger m-0 custom-small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Description edit form modal -->
<div class="modal fade" id="edit-description-recipe-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Recipe Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Recipes.edit', $recipe_data['id']) }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="hidden" value="edit-description-modal" />
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" aria-describedby="textHelp">{{ (old('description'))?old('description'):$recipe_data['description'] }}</textarea>
                    <div id="textHelp" class="form-text">Description must not be more than 45 letters.</div>
                    @error('description')
                        <span class="text-danger m-0 custom-small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Other details modal -->
<div class="modal fade" id="edit-otherDetails-recipe-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Recipe Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Recipes.edit', $recipe_data['id']) }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="hidden" value="edit-otherDetails-modal" />
                    <label class="form-label">Duration</label>
                    <input name="duration" class="form-control" aria-describedby="textHelp" value="{{ (old('duration')) ? old('duration') : $recipe_data['moreInfo']['duration'] }}"/>
                    <div id="textHelp" class="form-text">Duration must not be more than 20 letters.</div>
                    @error('duration')
                        <span class="text-danger m-0 custom-small d-block">{{ $message }}</span>
                    @enderror
                    <label class="form-label">Good For</label>
                    <input name="good_for" class="form-control" aria-describedby="textHelp" value="{{ (old('good_for'))?old('good_for'):$recipe_data['moreInfo']['good_for'] }}"/>
                    <div id="textHelp" class="form-text">Good for must not be more than 20 letters.</div>
                    @error('good_for')
                        <span class="text-danger m-0 custom-small d-block">{{ $message }}</span>
                    @enderror
                    <label class="form-label">Difficulty</label>
                    <input name="difficulty" class="form-control" aria-describedby="textHelp" value="{{ (old('difficulty'))?old('difficulty'):$recipe_data['moreInfo']['difficulty'] }}"/>
                    <div id="textHelp" class="form-text">Difficulty must not be more than 20 letters.</div>
                    @error('difficulty')
                        <span class="text-danger m-0 custom-small d-block">{{ $message }}</span>
                    @enderror
                    <label class="form-label">Budget</label>
                    <input name="budget" class="form-control" aria-describedby="textHelp" value="{{ (old('budget'))?old('budget'):$recipe_data['moreInfo']['budget'] }}"/>
                    <div id="textHelp" class="form-text">Duration must not be more than 20 letters.</div>
                    @error('budget')
                        <span class="text-danger m-0 custom-small d-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit for ingredients modal -->
<div class="modal fade" id="edit-ingredients-recipe-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Recipe Ingredients</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Recipes.edit', $recipe_data['id']) }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="hidden" value="edit-ingredients-modal" />
                    <label class="form-label">Ingredients</label>
                    <textarea name="ingredients" class="form-control" aria-describedby="textHelp">{{ (old('ingredients'))?old('ingredients'):$recipe_data['list_of_ingredients'] }}</textarea>
                    <div id="textHelp" class="form-text">Separate each ingredients with tilde character (~).</div>
                    @error('ingredients')
                        <span class="text-danger m-0 custom-small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Cooking method edit modal -->
<div class="modal fade" id="edit-method-recipe-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Cooking Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Recipes.edit', $recipe_data['id']) }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="hidden" value="edit-method-modal" />
                    <label class="form-label">Cooking Method</label>
                    <textarea name="method" class="form-control" aria-describedby="textHelp">{{ (old('method'))?old('method'):$recipe_data['instructions'] }}</textarea>
                    <div id="textHelp" class="form-text">Separate each instructions with tilde character (~).</div>
                    @error('method')
                        <span class="text-danger m-0 custom-small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Main recipe picture -->
<div class="modal fade" id="edit-mainImg-recipe-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload new picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Recipes.edit', $recipe_data['id']) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div>
                        <input type="hidden" name="hidden" value="main_recipeImg_modal" />
                        <input type="hidden" name="recipe_id" value="{{ $recipe_data['id'] }}" />
                        <input type="hidden" name="original_url" value="{{ $recipe_data['url'] }}" />
                        <label class="form-label">Upload picture</label>
                        <input name="main_recipe_img" class="form-control form-control-lg" type="file">
                    </div>
                    @error('main_recipe_img')
                        <span class="text-danger m-0 custom-small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Sub picture modal -->
<div class="modal fade" id="edit-sub-recipe-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload new picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Recipes.edit', $recipe_data['id']) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div>
                        <input type="hidden" name="hidden" value="main_sub_modal" />
                        <input type="hidden" name="recipe_id" value="{{ $recipe_data['id'] }}" />
                        <input id="hidden-sub-pics" type="hidden" name="original_url"/>
                        <label class="form-label">Upload picture</label>
                        <input name="sub_recipe_img" class="form-control form-control-lg" type="file">
                    </div>
                    @error('sub_recipe_img')
                        <span class="text-danger m-0 custom-small">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
