@extends('layouts.manage')


@section('content')
<div class="flex-container">
	<div class="columns m-t-10">
		<div class="column">
			<h1 class="title">Manage Roles</h1>
		</div>
		@foreach(auth()->user()->roles as $user_role) {{-- Check if user is superadministrator  --}}
			@if($user_role['role_level'] == 90)
				<div class="column">
					<a href="{{ route('roles.create') }}" class="button is-primary is-pulled-right"><i class="fa fa-user-plus m-r-10"> Create New Role</i></a>
				</div>
			@endif
		@endforeach
	</div>

	<hr style="background-color: silver; height: 0.5px;">

{{-- Including Errors Page --}}
@include('layouts.errors')

	<div class="columns is-multiline">
		@foreach(auth()->user()->roles as $user_role)
			@if($user_role['role_level'] >= 80) {{-- Check if user is superadministrator or administrator --}}
				@foreach($roles as $role)
					<div class="column is-one-quarter">
						<div class="box">
							<article class="media">
								<div class="media-content">
									<div class="content">
										<h3 class="title">{{ $role->display_name }}</h3>
										<h4 class="subtitle"><em>{{ $role->name }}</em></h4>
										<p>
											{{ $role->description }}
										</p>
									</div>

									<nav class="columns is-mobile"> {{-- Edit and Details buttons --}}
										<div class="column is-one-half">
											<a href="{{ route('roles.show', $role->id) }}" class="button is-primary is-fullwidth">Details</a>
										</div>
										<div class="column is-one-half">
											<a href="{{ route('roles.edit', $role->id) }}" class="button is-light is-fullwidth">Edit</a>
										</div>
									</nav>

								</div> {{-- end of .media-content --}}
							</article> 
						</div>
					</div> {{-- end of .column --}}
				@endforeach
			@endif
		@endforeach
	</div> {{-- end of .columns --}}
</div> {{-- end of .flex-container --}}
@endsection