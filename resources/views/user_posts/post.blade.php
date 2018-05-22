<div class="card">
	<div class="card-header">
		<div class="card-header-title"><i>{{ $post->title }}</i></div>
		<p class="is-right p-t-10 p-r-10" style="font-size: 15px;">{{ $post->created_at->toDayDateTimeString() }}</p>
	</div>

	<div class="card-content">
		{{ $post->content }}
	</div>

	<div class="card-footer">
		<div class="card-footer p-l-5 p-t-5 p-b-5">
			<i>Created by: {{ $post->author_name }}</i>
		</div>
	</div>
	
</div>