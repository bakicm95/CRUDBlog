<div class="side-menu">
	<aside class="menu m-t-30 m-l-10">
		<p class="menu-label">General</p>
		<ul class="menu-list"> {{-- Dashboard Link --}}
			<li><a href="{{ route('manage.dashboard') }}" class="{{ Nav::isRoute('manage.dashboard') }}">Dashboard</a></li>
		</ul>
			
		@foreach(auth()->user()->allPermissions() as $perm) {{-- Check for User's Permissions --}}
			@if($perm['name'] == 'create-post')
				<p class="menu-label">Content</p>
				<ul class="menu-list">
					<li><a href="{{ route('posts.index') }}" class="{{ Nav::isResource('posts', 2) }}">Blog Posts</a></li>
				</ul>
			@endif
		@endforeach

		@role('superadministrator|administrator') {{-- Display if User has role superadministrator or adminsitrator --}}
			<p class="menu-label">Administration</p>
			<ul class="menu-list">
				<li><a href="{{ route('users.index') }}" class="{{ Nav::isResource('users') }}">Manage Users</a></li>
				<li><a class="has-submenu {{ Nav::hasSegment(['roles', 'permissions'], 2) }}">Roles &amp; Permissions</a>
				<ul class="submenu">
					<li><a href="{{ route('roles.index') }}" class="{{ Nav::isResource('roles') }}">Roles</a></li>
					<li><a href="{{ route('permissions.index') }}" class="{{ Nav::isResource('permissions') }}">Permissions</a></li>
				</ul>
				</li>
			</ul>
		@endrole
	</aside>
</div>