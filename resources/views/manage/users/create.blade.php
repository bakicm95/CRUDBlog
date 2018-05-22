@extends('layouts.manage')


@section('content')

	<div class="flex-container">
		<div class="columns m-t-10">
			<div class="column">
				<h2 class="title">Create New User</h2>
			</div>
		</div>

		<hr class="m-t-0" style="background-color: silver; height: 0.5px;">
		
		{{-- Form For Users --}}
		<form action="{{ route('users.store') }}" method="post">
			{{ csrf_field() }}
			<div class="columns">
				<div class="column">

					<div class="filed"> {{-- Name --}}
						<label for="name" class="label">Name</label>
						<p class="control">
							<input type="text" class="input" name="name" id="name">
						</p>
					</div>

					<div class="filed m-t-5"> {{-- Email --}}
						<label for="email" class="label">Email</label>
						<p class="control">
							<input type="email" class="input" name="email" id="email">
						</p>
					</div>

					<div class="filed m-t-5"> {{-- Password --}}
						<label for="password" class="label">Password</label>
						<p class="control">
							<input type="password" class="input" name="password" id="password" v-if="!auto_password" placeholder="Manually give a password to this user">
							<b-checkbox name="auto_generate" class="m-t-10" v-model="auto_password">Auto Generate Password</b-checkbox>
						</p>
					</div>

				</div> {{-- end of the .column --}}
				<div class="column">
					<label for="roles" class="label">Roles:</label>
					<input type="hidden" name="roles" :value="rolesSelected">
					@foreach($roles as $role)
						@foreach(auth()->user()->roles as $item) {{-- Check if User is superadministrator --}}
							<div class="field" v-if="{{ $item['role_level'] }} == 90">
								<b-checkbox v-model="rolesSelected" :native-value="{{ $role->id }}">{{ $role->display_name }}</b-checkbox>
							</div>

							<div class="field" v-if="{{ $item['role_level'] }} < 90"> {{-- If User is not superadministrator --}}
								<b-checkbox v-model="rolesSelected" v-if="{{ $item['role_level'] }} > {{ $role->role_level }}" 
								 :native-value="{{ $role->id }}">{{ $role->display_name }}</b-checkbox>
							</div>
						@endforeach
					@endforeach			
				</div>
			</div> {{-- end of .columns --}}

			<div class="columns">
				<div class="column">
					<hr class="m-t-0" style="background-color: silver; height: 1px;"> {{-- Submit Btn --}}
					<button class="button is-primary is-pulled-right m-t-10" style="width: 250px;">Create User</button>
				</div>
			</div>
		</form> {{-- end of form --}}

	</div> {{-- end of .flex-container --}}
@endsection

{{-- Scripts Section --}}
@section('scripts')
 <script>
    var app = new Vue({
      el: '#app',
      data: {
        auto_password: true,
        rolesSelected: [{!! old('roles') ? old('roles') : '' !!}]
      }
    });
  </script>
@endsection
