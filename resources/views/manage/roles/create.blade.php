@extends('layouts.manage')


@section('content')
<div class="flex-container">
	<div class="columns m-t-10">
		<div class="column">
			<h1 class="title">Create New Role</h1>
		</div>
	</div>

	<hr style="background-color: silver; height: 0.5px;">
	
	{{-- Form for Roles --}}
	<form action="{{ route('roles.store') }}" method="POST">
		{{ csrf_field() }}

		<div class="columns">
			<div class="column">
				<div class="box">
					<article class="media">
					 <div class="media-content">
							<div class="content">
								<h2 class="title">Role Details:</h2>

								<div class="field">
									<p class="control">{{-- Role Display Name --}}
										<label for="display_name" class="label">Name (Human Readable)</label>
										<input type="text" class="input" name="display_name" id="display_name" value="{{ old('display_name') 
									</p>
								</div>

								<div class="field">
									<p class="control"> {{-- Role Slug --}}
										<label for="name" class="label">Slug (Can not be changed)</label>
										<input type="text" class="input" name="name" id="name" value="{{ old('name') }}">	
									</p>
								</div>

								<div class="field">
									<p class="control"> {{-- Role Description --}}
										<label for="description" class="label">Description</label>
										<input type="text" class="input" name="description" id="description" value="{{ old('description') }}">	
									</p>
								</div>

								<input type="hidden" :value="permissionsSelected" name="permissions">
							</div> {{-- end of .content --}}
						</div> 
					</article> {{-- end of article --}}
				</div> 
			</div>
		</div> {{-- end of .columns --}}
	

		<div class="columns">
			<div class="column">
				<div class="box">
					<article class="media">
					 <div class="media-content">
							<div class="content">
								<h2 class="title">Permissions:</h2>
								
									@foreach($permissions as $permission) {{-- Listing all permissions --}}
										<div class="field">
											<b-checkbox v-model="permissionsSelected" native-value="{{ $permission->id }}">{{ $permission->display_name }} <em>({{ $permission->description }})</em></b-checkbox>
										</div>
									@endforeach
								
							</div> {{-- end of .content --}}
						</div> 
					</article>
				</div> {{-- end of .box --}}
				<button class="button is-primary">Create New Role</button>
			</div>
		</div> {{-- end of .columns --}}
	</form>
</div> {{-- end of .flex-container --}}
@endsection

{{-- Scripts section --}}
@section('scripts')
	<script>
		var app = new Vue({
			el: '#app',
			data: {
				permissionsSelected: []
			}
		});
	</script>
@endsection