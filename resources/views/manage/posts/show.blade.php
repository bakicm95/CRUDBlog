@extends('layouts.manage')


@section('content')
<div class="flex-container">
	<div class="columns m-t-10">
		<div class="column">
			<h1 class="title">Posts</h1>
		</div>
		
		{{-- Check for User's roles --}}
		@foreach(auth()->user()->roles as $user_role)
			@if($user_role['role_level'] == 90 || auth()->user()->id == $post->author_id)
				<div class="columns m-t-5 m-r-10">
					{{-- Edit Post Btn --}}
					<div class="column">
						<a href="{{ route('posts.edit', $post->id) }}" class="button is-primary is-pulled-right"><i class="fa fa-edit m-r-10"></i> Edit Post</i></a>
					</div>
					{{-- Delete Post Btn --}}
					<div class="column">
						<form action="{{ route('destroy_post', $post->id) }}" method="post">
							{{ csrf_field() }}
							<button class="button is-danger is-pulled-right">Delete Post</button>
						</form>
					</div>
				</div> {{-- end of .columns --}}
			@endif
		@endforeach
	</div>

	<hr style="background-color: silver; height: 0.5px;">
	
	
	<div class="columns">
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
		</div>
	</div> {{-- end of .columns --}}
</div> {{-- end of .flex-container --}}


@endsection