@if(count($errors))
	<div class="field p-t-10 p-l-10 p-b-10" style=" width: 350px; border: 1px solid red; border-radius: 20px;">
		<div class="has-text-danger" style="">
			<ul>
				@foreach($errors->all() as $error)
					<li>- {{ $error }}</li>
				@endforeach
			</ul>
		</div>
	</div>
@endif