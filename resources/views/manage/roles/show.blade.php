@extends('layouts.manage')


@section('content')
<div class="flex-container">
	<div class="columns m-t-10">
		<div class="column">
			<h1 class="title">{{ $role->display_name }}<small class="m-l-5"><em>({{ $role->name }})</em></small></h1>
			<h5>{{ $role->description }}</h5>
		</div>
		@foreach(auth()->user()->roles as $user_role)
			@if($user_role['role_level'] == 90) {{-- Check if User is superadministrator --}}
				<div class="columns m-t-5 m-r-10">

					<div class="column" style="margin-left: -20px;"> {{-- Edit Role Btn --}}
						<a href="{{ route('roles.edit', $role->id) }}" class="button is-primary is-pulled-right"><i class="fa fa-edit m-r-10"></i> Edit Role</i></a>
					</div>

					<div class="column"> {{-- Delete Role Btn --}}
						<form action="{{ route('destroy_role', $role->id) }}" method="post">
							{{ csrf_field() }}
							<button class="button is-danger is-pulled-right">Delete Role</button>
						</form>
					</div>

				</div> {{-- end of .columns --}}
			@endif
		@endforeach
	</div>

	<hr style="background-color: silver; height: 0.5px;">
	
	<div class="columns">
		<div class="column">
			<div class="box">
				<article class="media">
				 	<div class="media-content">
						<div class="content">
							<h2 class="title">Permissions:</h2>
							<ul>
								@foreach($role->permissions as $r) {{-- List all of Roles Permissions --}}
									<li>{{ $r->display_name }} <em class="m-l-15">({{ $r->description }})</em></li>
								@endforeach
							</ul>
						</div>
					</div> 
				</article> {{-- end of article --}}
			</div>
		</div>
	</div> {{-- end of .columns --}}
</div> {{-- end of .container-flex --}}
@endsection