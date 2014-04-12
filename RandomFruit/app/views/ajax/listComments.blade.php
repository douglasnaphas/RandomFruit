@foreach($ticket->comments as $comment)
<div class="comment">
	<div class="comment-info">Author: {{$comment->user->username}} Date: {{$comment->user->created_at}}</div>
	<div class="comment-text">
		{{$comment->parsedContent()}}
	</div>
</div>
@endforeach
