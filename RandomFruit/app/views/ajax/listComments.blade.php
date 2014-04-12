@foreach($ticket->comments as $comment)
<div class="comment panel panel-default">
	<div class="comment-info panel-heading">Author: {{$comment->user->username}} Date: {{$comment->user->created_at}}</div>
	<div class="comment-text panel-body">
		{{$comment->parsedContent()}}
	</div>
</div>
@endforeach
