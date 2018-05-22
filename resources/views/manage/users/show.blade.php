@extends('layouts.manage')


@section('content')

<div class="flex-container">
	<div class="columns m-t-10">
		<div class="column">
			<h2 class="title">View User Details</h2>
		</div> {{-- end of .column --}}
		
		@foreach(auth()->user()->roles as $user_role) 
			<div class="columns m-t-5 m-r-10">
				@foreach($user->roles as $item) {{-- Check if User is superadministrator or not --}}
					@if($user_role['role_level'] == 90 || $item['role_level'] < $user_role['role_level'])
						<div class="column">
							<a href="{{ route('users.edit', $user->id) }}" class="button is-primary is-pulled-right"><i class="fa fa-edit"></i><span class="m-l-10">Edit User</span></i></a>
						</div>
					@endif
				@endforeach

				@if($user_role['role_level'] == 90)
					<div class="column"> {{-- Check if User is superadministrator --}}
						<form action="{{ route('destroy_user', $user->id) }}" method="post">
							{{ csrf_field() }}
							<button class="button is-danger is-pulled-right"></i>Delete User</button>
						</form>
					</div>
				@endif
			</div> {{-- end of .columns --}}
		@endforeach
	</div> {{-- end of .columns --}}

	<hr class="m-t-0" style="background-color: silver; height: 0.5px;">

	<div class="columns">
		<div class="column">

			<div class="filed"> {{-- Name --}}
				<label for="name" class="label">Name</label>
				<pre>{{ $user->name }}</pre>
			</div>

			<div class="filed m-t-5"> {{-- Email --}}
				<label for="email" class="label">Email</label>
				<pre>{{ $user->email }}</pre>
			</div>

			<div class="filed m-t-5"> {{-- Roles --}}
				<label for="roles" class="label">Roles</label>
				<ul> {{-- Check if User have any roles --}}
					{{ $user->roles->count() == 0 ? 'This user has not been assigned any roles yet.' : '' }}
					@foreach($user->roles as $role)
						<li>{{ $role->display_name }} ({{ $role->description }})</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div> {{-- end of .columns  --}}
</div> {{-- end of .flex-container --}}

@endsection