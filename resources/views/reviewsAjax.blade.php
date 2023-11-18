

@foreach($comments as $comment)
<div class="custom-review-section">
    <div class="d-inline-block comment-container">
        <div>
            <small class="custom-reply">{{ $comment['user']['first_name'] }} {{ $comment['user']['last_name'] }}</small>
            <p class="custom-chatbox text-dark d-block">{{ $comment['content'] }}</p>
            <p class="custom-reply m-0 d-block"><small>{{ \App\Helpers\Commons::getTimeAgo($comment['created_at']) }}</small></p>
        </div>
    @foreach($comment['replies'] as $rep)
        <div class="mt-1">
            <small class="custom-reply d-block">{{  $rep['user']['first_name'] }} {{  $rep['user']['last_name'] }}</small>
            <p class="custom-chatbox-reply text-dark">{{ $rep['content'] }}</p>
            <p class="custom-reply m-0 d-block"><small>{{ \App\Helpers\Commons::getTimeAgo($rep['created_at']) }}</small></p>
        </div>
    @endforeach
    </div>
    <form id="reply-form" class="input-group p-1 pb-0">
        @csrf
        <input type="hidden" name="comment_id" value="{{ $comment['id'] }}"/>
        <input name="content" type="text" class="form-control" placeholder="{{ $errors->has('reply-input') ? $errors->first('reply-input') : 'Post a reply' }}" aria-label="Recipient's username" aria-describedby="button-addon2">
        <input id="comment-reply" class="btn btn-dark custom-chatbox-reply text-dark border border-0" type="submit" value="Reply"/>
    </form>
</div>
@endforeach