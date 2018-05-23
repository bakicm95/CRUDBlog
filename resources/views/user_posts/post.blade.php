<div class="card">
	<div class="card-header">
		<div class="card-header-title"><i><a href="{{ route('user_posts_show', $post->id) }}">{{ $post->title }}</a></i></div>
		<p class="is-right p-t-10 p-r-10" style="font-size: 15px;">{{ $post->created_at->toDayDateTimeString() }}</p>
	</div>

	<div class="card-content">
		{{ $post->content }}
	</div>

	<div class="card-footer">
		<div class="card-footer-item"><i>Created by: {{ $post->author_name }}</i></div>
		<div class="card-footer-item">This post has {{ count($post->comments) }} comments <a href="{{ route('user_posts_show', $post->id) }}"  class="p-l-10">@if(count($post->comments) == 0)  Comment first! @elseif(count($post->comments) > 0) Check it out!@endif</a></div>
	</div>
	
</div>