

@foreach($comments as $comment)
<div class="custom-review-section">
    <div class="d-inline-block comment-container">
        <div>
            <small class="custom-reply">{{ $comment['first_name'] }} {{ $comment['last_name'] }}</small>
            <p class="custom-chatbox text-dark d-block">{{ $comment['comment'] }}</p>
            <p class="custom-reply m-0 d-block"><small>{{ $comment['time'] }}</small></p>
        </div>
    @foreach($comment['replies'] as $rep)
        <div class="mt-1">
            <small class="custom-reply d-block">{{  $rep['first_name'] }} {{  $rep['last_name'] }}</small>
            <p class="custom-chatbox-reply text-dark">{{ $rep['reply'] }}</p>
            <p class="custom-reply m-0 d-block"><small>{{ $rep['reply_date'] }}</small></p>
        </div>
    @endforeach
    </div>
    <form id="reply-form" class="input-group p-1 pb-0">
        @csrf
        <input type="hidden" name="id" value="{{ $comment['id'] }}"/>
        <input name="comment-reply" type="text" class="form-control" placeholder="{{ $errors->has('reply-input') ? $errors->first('reply-input') : 'Post a reply' }}" aria-label="Recipient's username" aria-describedby="button-addon2">
        <input id="comment-reply" class="btn btn-dark custom-chatbox-reply text-dark border border-0" type="submit" value="Reply"/>
    </form>
</div>
@endforeach