<nav class="navbar has-shadow">
	<div class="container">
		<div class="navbar-start">
			<a href="" class="navbar-brand">
				<img src="{{asset('images/logo.png')}}" alt="" >
			</a>
			<a href="/" class="navbar-item is-tab is-hidden-mobile m-l-10">Blog</a>
			<a href="#" class="navbar-item is-tab is-hidden-mobile">About Us</a>
			<a href="#" class="navbar-item is-tab is-hidden-mobile">Contact</a>
		</div>
		<div class="navbar-end">
			@if(Auth::guest()) 
				<a href="{{ route('login') }}" class="navbar-item is-tab">Login</a>
				<a href="{{ route('register') }}" class="navbar-item is-tab">Join the Community</a>
			@else
				<button class="dropdown is-aligned-right navbar-item is-tab">Hey 
					{{ auth()->user()->name }} <span class="icon"><i class="fa fa-caret-down"></i></span>
					<ul class="dropdown-menu">
						<li><a href="{{ route('profile.index') }}">
						<span class="icon"><i class="fa fa-fw m-r-10 fa-user-circle-o"></i></span>
						Profile</a></li>

						<li><a href="{{ route('manage.dashboard') }}">
						<span class="icon"><i class="fa fa-fw m-r-10 fa-cog"></i></span>
						Manage</a></li>

						<li class="seperator"></li>
						
						<li><a href="{{ route('logout') }}">
						<span class="icon"><i class="fa fa-fw m-r-10 fa-sign-out"></i></span>
						Logout</a></li>
					</ul>
				</button>
			@endif
		</div> {{-- end of .navbar-end  --}}
	</div> {{-- end of .container  --}}
</nav>