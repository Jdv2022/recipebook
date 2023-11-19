@foreach($recipe_data['subPictures'] as $item)
<div class="col-3 pt-1 pb-1 position-relative">
    <div class="custom-height-100 d-flex align-items-center">
        <img class="img-fluid recipe-imgs" src="{{ asset($item['url']) }}" alt="Dish">
    </div>
    @if(Auth::id() === $recipe_data['id'])
        <a class="upload-recipe-button subs" href="#" data-sub="{{ $item['url'] }}" >Upload</a>
    @endif
</div>
@endforeach
@if(count($recipe_data['subPictures']) < 4)
@php
    $count = 4 - count($recipe_data['subPictures']);
@endphp
@for($index = $count; $index > 0; $index--)
<div class="col-3 pt-1 pb-1 position-relative">
    <div class="custom-height-100 d-flex align-items-center">
        <img class="img-fluid recipe-imgs m-auto" src="{{ asset('img/sub.png') }}" alt="Dish">
    </div>
    @if(Auth::id() === $recipe_data['id'])
        <a class="upload-recipe-button subs" href="#" data-sub="{{ $item['url'] }}" >Upload</a>
    @endif
</div>
@endfor
@endif

