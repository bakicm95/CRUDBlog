@extends('layouts.manage')


@section('content')

<div class="flex-container">
	<div class="columns m-t-10">
		<div class="column">
			<h2 class="title">Edit User</h2>
		</div>
	</div>
	
	<hr class="m-t-0" style="background-color: silver; height: 0.5px;">
	
	{{-- Errors Page --}}
	@include('layouts.errors')

	{{-- Form Form Editing --}}
	<form action="{{ route('users.update', $user->id) }}" method="post">
		{{method_field('PUT')}}
		{{ csrf_field() }}
		<div class="columns">
			<div class="column">

				<div class="filed">
					<label for="name" class="label">Name</label> {{-- Name --}}
					<p class="control">
						<input type="text" class="input" name="name" id="name" value="{{ $user->name }}">
					</p>
				</div>

				<div class="filed m-t-5"> {{-- Email --}}
					<label for="email" class="label">Email</label>
					<p class="control">
						<input type="email" class="input" name="email" id="email" value="{{ $user->email }}">
					</p>
				</div>

				<div class="filed m-t-5"> {{-- Password --}}
					<label for="password" class="label">Password</label>

					<div class="field"> {{-- Radio Buttons For Pasword Changing Type --}}
						<b-radio name="password_options" v-model="password_options" native-value="keep">Do Not Change Password</b-radio>
					</div>

					<div class="field">
						<b-radio name="password_options" v-model="password_options" native-value="auto">Auto-Generate New Password</b-radio>
					</div>

					<div class="field">
						<b-radio name="password_options" v-model="password_options" native-value="manual">Manually Set New Password</b-radio>
						<p class="control">
							<input type="password" class="input m-t-10" name="password" id="password" v-if="password_options == 'manual' " placeholder="Manually give a password to this user">
						</p>
					</div>

				</div> {{-- end of .filed --}}
			</div> {{-- end of the .column --}}

			<div class="column">
				<label for="roles" class="label">Roles:</label> {{-- Roles --}}
				<input type="hidden" name="roles" :value="rolesSelected">
				@foreach($roles as $role)
					@foreach(auth()->user()->roles as $user_role)
						<div class="field" v-if="{{ $user_role['role_level'] }} == 90">
							<b-checkbox v-model="rolesSelected" :native-value="{{ $role->id }}">{{ $role->display_name }}</b-checkbox>
						</div>

						<div class="field" v-if="{{ $user_role['role_level'] }} < 90">
							<b-checkbox v-model="rolesSelected" v-if="{{ $user_role['role_level'] }} > {{ $role->role_level }}" 
							 :native-value="{{ $role->id }}">{{ $role->display_name }}</b-checkbox>
						</div>
					@endforeach
				@endforeach			
			</div>
		</div> {{-- end of .columns --}}


		<div class="columns">
			<div class="column">
				<hr class="m-t-0" style="background-color: silver; height: 1px;">
				<button class="button is-primary m-t-10" style="width: 250px;">Edit User</button>
			</div>
		</div>
	</form>
</div> {{-- end of .flex-container --}}

@endsection

@section('scripts')
<script>

	var app = new Vue({
		el: '#app',
		data: {
			password_options: 'keep',
			rolesSelected: {!! $user->roles->pluck('id') !!}
		}
	});

</script>
@endsection

