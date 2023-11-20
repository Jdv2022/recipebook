<!-- Cover -->
<div class="modal fade" id="edit-cover-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload new Cover Photo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Users.edit') }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div>
                        <input type="hidden" name="hidden" value="cover_modal" />
                        <input id="hidden-cover-pic" type="hidden" name="original_url" value="{{ $user_data['userPicture']['cover_url'] }}"/>
                        <label class="form-label">Upload picture</label>
                        <input name="cover" class="form-control form-control-lg" type="file">
                    </div>
                    @error('cover_img')
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
<!-- Profile -->
<div class="modal fade" id="edit-profile-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload new picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Users.edit') }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div>
                        <input type="hidden" name="hidden" value="profile_modal" />
                        <input id="hidden-sub-pics" type="hidden" name="original_url" value="{{ $user_data['userPicture']['profile_url'] }}" />
                        <label class="form-label">Upload picture</label>
                        <input name="profile" class="form-control form-control-lg" type="file">
                    </div>
                    @error('profile_img')
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
<!-- Name -->
<div class="modal fade" id="edit-name-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Users.edit') }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="hidden" value="edit-profileName-modal" />
                    <label class="form-label">First name</label>
                    <input type="text" name="first_name" class="form-control" aria-describedby="textHelp" value="{{ $user_data['first_name'] }}">
                    <div id="textHelp" class="form-text">First name must not be more than 45 letters.</div>
                    @error('first_name')
                        <span class="text-danger m-0 custom-small">{{ $message }}</span>
                    @enderror
                    <label class="form-label">Last name</label>
                    <input type="text" name="last_name" class="form-control" aria-describedby="textHelp" value="{{ $user_data['last_name'] }}">
                    <div id="textHelp" class="form-text">Last name must not be more than 45 letters.</div>
                    @error('last_name')
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
<!-- location -->
<div class="modal fade" id="edit-location-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Users.edit') }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="hidden" value="edit-location-modal" />
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" aria-describedby="textHelp" value="{{ ($user_data)?$user_data['moreUserInfo']['location']:'' }}">
                    <div id="textHelp" class="form-text">Location must not be more than 50 letters.</div>
                    @error('location')
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
<!-- Email -->
<div class="modal fade" id="edit-email-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Users.edit') }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="hidden" value="edit-email-modal" />
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" aria-describedby="textHelp" value="{{ ($user_data)?$user_data['email']:'' }}">
                    <div id="textHelp" class="form-text">Email must not be more than 45 letters.</div>
                    @error('email')
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
<!-- About me -->
<div class="modal fade" id="edit-aboutMe-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('Users.edit') }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="hidden" value="edit-aboutMe-modal" />
                    <label class="form-label">About me</label>
                    <textarea name="about_me" class="form-control" aria-describedby="textHelp" >{{ $user_data['moreUserInfo']['about_me'] }}</textarea>
                    @error('about_me')
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