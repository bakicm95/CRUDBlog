@extends('layouts.manage')


@section('content')
<div class="flex-container">
	<div class="columns m-t-10">
		<div class="column">
			<h1 class="title">Edit {{ $role->display_name }}</h1>
		</div>
		<div class="column" style="margin-left: -20px;">
			
		</div>
	</div> {{-- end of .columns --}}

	<hr style="background-color: silver; height: 0.5px;">
	
	{{-- Form for Editing --}}
	<form action="{{ route('roles.update', $role->id) }}" method="POST">
		{{ csrf_field() }}
		{{ method_field('PUT') }}

		<div class="columns">
			<div class="column">
				<div class="box">
					<article class="media">
					 	<div class="media-content">
							<div class="content">
								<h2 class="title">Role Details:</h2>

								<div class="field">
									<p class="control"> {{-- Role Name --}}
										<label for="display_name" class="label">Name (Human Readable)</label>
										<input type="text" class="input" name="display_name" id="display_name" value="{{ $role->display_name }}">	
									</p>
								</div>

								<div class="field">
									<p class="control"> {{-- Role Slug --}}
										<label for="name" class="label">Slug (Can not be edited)</label>
										<input type="text" class="input" name="name" id="name" value="{{ $role->name }}" disabled>	
									</p>
								</div>

								<div class="field">
									<p class="control"> {{-- Role Slug --}}
										<label for="description" class="label">Description</label>
										<input type="text" class="input" name="description" id="description" value="{{ $role->description }}">	
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
								
									@foreach($permissions as $permission) {{-- List all Permissions --}}
										<div class="field">
											<b-checkbox v-model="permissionsSelected" native-value="{{ $permission->id }}">{{ $permission->display_name }} <em>({{ $permission->description }})</em></b-checkbox>
										</div>
									@endforeach
								
							</div>
						</div> {{-- end of .media-content --}}
					</article>
				</div> {{-- end of .box --}}
				<button class="button is-primary">Save Changes to Role</button>
			</div>
		</div> {{-- end of .columns --}}
	</form>
</div> {{-- end of .flex-container --}}
@endsection

{{-- Scripts Section --}}
@section('scripts')
	<script>
		var app = new Vue({
			el: '#app',
			data: {
				permissionsSelected: {!! $role->permissions->pluck('id') !!}
			}
		});
	</script>
@endsection