@extends('layouts.manage')

@section('content')


<div class="flex-container p-t-10">
	<div class="card m-t-20">
		<div class="columns p-t-10 p-l-5 p-b-10">
			{{-- Profile Info Column --}}
			<div class="column">
				<h1 style="font-size: 25px;"><i>Profile Info</i></h1>
				<hr style="background-color: silver; height: 0.5px;">
				<div class="p-l-5">
					<label for="name">Name:</label><i style="font-size: 20px;" class="p-l-10">  {{ $user->name }}</i>
					<hr style="background-color: silver; height: 1px;">

					<label for="email">Email:</label><i style="font-size: 20px;" class="p-l-10">  {{ $user->email }}</i>
					<hr style="background-color: silver; height: 1px;">

					<label for="date">Joined:</label><i style="font-size: 16px;" class="p-l-10"> {{ $user->created_at->toDayDateTimeString() }}</i>
					<hr style="background-color: silver; height: 1px;">

					<a href="{{ route('profile.create') }}" class="button is-primary">Change Password</a>
				</div>

			</div>

			<hr style="background-color: silver; height: 0.5px;">
			
			{{-- User Posts Column --}}
			<div class="column is-two-thirds" style="border-left: 1px solid silver;">
				<h1 style="font-size: 25px;"><i>User's Posts</i></h1>
				<hr style="background-color: silver; height: 0.5px;">
				@if(count($errors))
				<div class="p-l-50 p-t-20">
					@include('layouts.errors')
				</div>
				@endif
				<div class="content">

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

						<tbody>
							@foreach($posts as $post) {{-- Checking for posts --}}
							<tr>
								<th>{{ $post->id }}</th>
								<td>{{ $post->title }}</td>
								<td>{{ $post->author_name }}</td>
								<td>{{ $post->created_at->toFormattedDateString() }}</td>
								<td class="has-text-right"><a href="{{ route('posts.show', $post->id) }}" class="button is-outlined m-r-5">View</a>
									<a href="{{ route('posts.edit', $post->id) }}" class="button is-outlined">Edit</a></td>
								</tr>
								@endforeach
							</tbody>
							{{ $posts->links() }}
						</table> {{-- end of table --}}
						
						@if(count($posts) == 0) {{-- If User have no posts --}}
							<h1><span style="border: 1px solid red; border-radius: 25px; padding: 10px; font-size: 20px; font-weight: normal;">You have no posts created yet, if You have no permission, Your rank is too low.</span></h1>
						@endif
						
					</div>
				</div>
			</div> {{-- end of .columns --}}
		</div>
	</div> {{-- end of .flex-container --}}

@endsection