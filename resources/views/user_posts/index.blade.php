@extends('layouts.app')


@section('content')
	
	<div class="flex-container">
		<div class="columns">
			<div class="column is-three-quarters">
				<h1 class="title">Blog Posts</h1>

					@foreach($posts as $post) {{-- Check for Posts --}}
						@include('user_posts.post')
						<div class="m-t-30"></div>
					@endforeach
			</div>
			<div class="column"></div>
		</div>
	</div> {{-- end of .flex-container --}}

@endsection