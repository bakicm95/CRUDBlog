@extends('layouts.manage')

{{-- Check for User's permissions --}}

	 @if(auth()->user()->can(['create-post']))
		@section('content')
		<div class="flex-container">
			<div class="columns m-t-10">
				<div class="column">
					<h1 class="title">Posts</h1>
				</div>
				{{-- New Post Button --}}
				<div class="column">
					<a href="{{ route('posts.create') }}" class="button is-primary is-pulled-right"><i class="fa fa-plus-circle m-r-10"> Create New Post</i></a>
				</div>
			</div>

			<hr style="background-color: silver; height: 0.5px;">
			

			<div class="card">
				@if(count($errors))
					<div class="p-l-50 p-t-20">
						@include('layouts.errors')
					</div>
				@endif
				<div class="card-content">
					{{-- Posts table --}}
					<table class="table is-narrow" style="width: 100%;">
						<thead>
							<tr>
								<th>id</th>
								<th>Title</th>
								<th>Created By</th>
								<th>Date Created</th>
								<th></th>
							</tr>
						</thead>

						<tbody> {{-- Check for User's roles --}}
							@foreach(auth()->user()->roles as $user_role)
								@if($user_role['role_level'] >= 80)
									@foreach($posts as $post)
										<tr>
											<th>{{ $post->id }}</th>
											<td>{{ $post->title }}</td>
											<td>{{ $post->author_name }}</td>
											<td>{{ $post->created_at->toFormattedDateString() }}</td>
											<td class="has-text-right"><a href="{{ route('posts.show', $post->id) }}" class="button is-outlined m-r-5">View</a>
												<a href="{{ route('posts.edit', $post->id) }}" class="button is-outlined">Edit</a></td>
											</tr>
									@endforeach
								@endif
								
								{{-- Check for User's Roles --}}
								@if($user_role['role_level'] < 80)
									@foreach($user_posts as $user_post)
										<tr>
											<th>{{ $user_post->id }}</th>
											<td>{{ $user_post->title }}</td>
											<td>{{ $user_post->author_name }}</td>
											<td>{{ $user_post->created_at->toFormattedDateString() }}</td>
											<td class="has-text-right"><a href="{{ route('posts.show', $user_post->id) }}" class="button is-outlined m-r-5">View</a>
												<a href="{{ route('posts.edit', $user_post->id) }}" class="button is-outlined">Edit</a></td>
											</tr>
									@endforeach
								@endif

							@endforeach {{-- end of top foreach --}}
						</tbody>
					</table>
				</div>
			</div> {{-- end of .card --}}

				{{ $posts->links() }}

		</div> {{-- end of .flex-container --}}

		@endsection
	@endif

