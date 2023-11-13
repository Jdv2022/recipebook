
<div class="modal fade" id="edit-recipe-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Recipe Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Recipes.edit', $data['id']) }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="hidden" value="edit-modal-title" />
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" aria-describedby="textHelp" value="{{ old('title') }}">
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