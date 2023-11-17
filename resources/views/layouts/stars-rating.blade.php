@php
    $count = $rate;
@endphp
@for($i = 1; $i <= 5; $i++)
@if($count >= 1)
    <svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
        <polygon points="50,10 61.8,37.6 90,37.6 66.2,54.4 78.4,81 50,64.2 21.6,81 33.8,54.4 10,37.6 38.2,37.6" fill="orange" stroke="orange" stroke-width="10px" />
    </svg> 
@elseif($count < 1 && $count > 0)
    <svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
        <polygon points="50,10 61.8,37.6 90,37.6 66.2,54.4 78.4,81 50,64.2 21.6,81 33.8,54.4 10,37.6 40,37.6" fill="white" stroke="orange" stroke-width="10px" />
        <polygon points="50,10 50,64.2 21.6,81 35,54.4 27,37.6" fill="orange" />
    </svg>
@else
    <svg class="m-2" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 100 100">
        <polygon points="50,10 61.8,37.6 90,37.6 66.2,54.4 78.4,81 50,64.2 21.6,81 33.8,54.4 10,37.6 38.2,37.6" fill="white" stroke="orange" stroke-width="10px" />
    </svg> 
@endif
@php
    $count -= 1;
@endphp
@endfor