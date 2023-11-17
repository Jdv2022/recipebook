<div class="col-3 pt-1 pb-1 position-relative">
    <div class="custom-height-100 d-flex align-items-center">
    @if(isset($sub_pictures['0']))
        <img class="img-fluid recipe-imgs" src="{{ asset($sub_pictures['0']) }}" alt="Dish">
    @else
        <img class="img-fluid recipe-imgs m-auto" src="{{ asset('img/sub.png') }}" alt="Dish">
    @endif
    </div>
    @if(Auth::id() === $user_data['id'])
        <a class="upload-recipe-button" href="#" data-sub="{{isset($sub_pictures['0'])?$sub_pictures['0']:''}}" >Upload</a>
    @endif
</div>
<div class="col-3 pt-1 pb-1 position-relative">
    <div class="custom-height-100 d-flex align-items-center">
    @if(isset($sub_pictures['1']))
        <img class="img-fluid recipe-imgs" src="{{ asset(isset($sub_pictures['1'])?$sub_pictures['1']:'') }}" alt="Dish">
    @else
        <img class="img-fluid recipe-imgs m-auto" src="{{ asset('img/sub.png') }}" alt="Dish">
    @endif
    </div>
    @if(Auth::id() === $user_data['id'])
        <a class="upload-recipe-button" href="#" data-sub="{{isset($sub_pictures['1'])?$sub_pictures['1']:''}}" >Upload</a>
    @endif
</div>
<div class="col-3 pt-1 pb-1 position-relative">
    <div class="custom-height-100 d-flex align-items-center">
    @if(isset($sub_pictures['2']))
        <img class="img-fluid recipe-imgs" src="{{ asset(isset($sub_pictures['2'])?$sub_pictures['2']:'') }}" alt="Dish">
    @else
        <img class="img-fluid recipe-imgs m-auto" src="{{ asset('img/sub.png') }}" alt="Dish">
    @endif    
    </div>
    @if(Auth::id() === $user_data['id'])
        <a class="upload-recipe-button" href="#" data-sub="{{isset($sub_pictures['2'])?$sub_pictures['2']:''}}" >Upload</a>
    @endif
</div>
<div class="col-3 pt-1 pb-1 position-relative">
    <div class="custom-height-100 d-flex align-items-center">
    @if(isset($sub_pictures['2']))
        <img class="img-fluid recipe-imgs" src="{{ asset(isset($sub_pictures['3'])?$sub_pictures['3']:'') }}" alt="Dish">
    @else
        <img class="img-fluid recipe-imgs m-auto" src="{{ asset('img/sub.png') }}" alt="Dish">
    @endif  
    </div>
    @if(Auth::id() === $user_data['id'])
        <a class="upload-recipe-button" href="#" data-sub="{{isset($sub_pictures['3'])?$sub_pictures['3']:''}}" >Upload</a>
    @endif
</div>