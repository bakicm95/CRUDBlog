@extends('layouts.manage')


@section('content')

<div class="flex-container">
	<div class="columns m-t-10">
		<div class="column">
			<h2 class="title">Change Password</h2>
		</div>
	</div>

	<hr class="m-t-0" style="background-color: silver; height: 0.5px;">
	{{-- Errors page included --}}
	@include('layouts.errors')
	
	{{-- Profile Form --}}
	<form action="{{ route('profile.update', auth()->user()->id) }}" method="post">
		{{ method_field('PUT') }}
		{{ csrf_field() }}
		<div class="columns">
			<div class="column">
				<div class="filed"> {{-- Current Password --}}
					<label for="current-password" class="label">Current Password</label>
					<p class="control">
						<input type="password" class="input" name="current-password" id="current-password">
					</p>
				</div>

				<div class="filed m-t-5"> {{-- New Password --}}
					<label for="new-password" class="label">New Password</label>
					<p class="control">
						<input type="password" class="input" name="new-password" id="new-password">
					</p>
				</div>

				<div class="filed m-t-5"> {{-- New Password Confirmed --}}
					<label for="new-password-confirmed" class="label">Confirm New Password</label>
					<p class="control">
						<input type="password" class="input" name="new-password_confirmation" id="new-password_confirmation">
					</p>
				</div>
				
			</div> {{-- end of the .column --}}
		</div>


		<div class="columns">
			<div class="column">
				<hr class="m-t-0" style="background-color: silver; height: 1px;">
				<input type="submit" class="button is-primary" value="Change Password">
			</div>
		</div> {{-- end of .columns --}}
	</form>
</div> {{-- end of .flex-container --}}

@endsection



