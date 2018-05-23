@extends('layouts.app')


@section('content')
<div class="flex-container">
	<div class="columns m-t-50">
			<div class="column">
				<div class="card">
					<div class="card-header"> {{-- Post Title --}}
						<div class="card-header-title"><i>{{ $post->title }}</i></div>
					</div>
					
					<div class="card-content">
						{{ $post->content }} {{-- Post Content --}}
					</div>

					<div class="card-footer">
						<div class="card-footer-item"> {{-- Author Name --}}
							<span class="p-r-20"><i>By:</i></span>{{ $post->author_name }}
						</div>

						<div class="card-footer-item"> {{-- Post Slug --}}
							<span class="p-r-20"><i>Slug:</i></span>{{ $post->slug }}
						</div>

						<div class="card-footer-item"> {{-- Post created date --}}
							<span class="p-r-20"><i>Date:</i></span>{{ $post->created_at->toDayDateTimeString() }}
						</div>
					</div> {{-- end of .card-footer --}}
				</div> {{-- end of .card --}}
				
				{{-- COMMENTS AREA  --}}

				<div class="card m-t-20">
					@if(count($post->comments) == 0)
						<div class="card-content">
							This post has no comments!
						</div>
					@endif
					@foreach($post->comments as $comment)
						<div class="flex-container">
							<div class="card m-t-10">
								<div class="card-header p-t-5 p-l-5 p-b-5">By: {{ $comment->name }}</div>
								<div class="card-content">{{ $comment->body }}</div>
								<div class="card-footer p-t-5 p-l-5 p-b-5">{{ $comment->created_at->diffForHumans() }}</div>
							</div>
							<hr style="background-color: silver; height: 0.5px;">
						</div>
					@endforeach

				</div> {{-- end of .card --}}

				<div class="card m-t-20" style="width: 500px;">
					<p class="p-t-10">@include('layouts.errors')</p>
					<div class="card-content">
						<form action="{{ route('make_comm', $post->id) }}" method="post">
							{{ csrf_field() }}
							<label for="comment" class="label">Comment Post</label>
							<textarea type="text" class="textarea" name="body" placeholder="Insert your comment"></textarea>
							<input type="submit" value="Add comment" class="button is-primary m-t-10">
						</form>
					</div>
				</div>
				

			</div>
	</div> {{-- end of .columns --}}
</div>
@endsection