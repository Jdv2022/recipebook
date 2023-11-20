

<h2 class="m-0 p-0 mb-5 text-center">Ratings<h2>
<ol class="list-group">
@foreach($rating_data as $key => $value)
    <li class="list-group-item d-flex justify-content-between align-items-start custom-reviews align-items-center">
        <p class="mt-2 mb-2">
            {{ $key }} 
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
                <polygon points="50,10 61.8,37.6 90,37.6 66.2,54.4 78.4,81 50,64.2 21.6,81 33.8,54.4 10,37.6 38.2,37.6" fill="orange" stroke="orange" stroke-width="3px" />
            </svg> 
        </p>
        <span class="badge bg-primary rounded-pill">{{ $value }}</span>
    </li>
@endforeach
</ol>
@if(!Auth::id())
<a class="btn btn-dark custom-nav-color border border-0 mt-5" data-bs-toggle="modal" data-bs-target="#login-modal">Rate Recipe</a>
@elseif($alreadyRated)
<button type="button" class="btn btn-secondary mt-5" disabled>Already Rated</button>
@else
<a class="btn btn-dark custom-nav-color border border-0 mt-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Rate Recipe</a>
@endif
