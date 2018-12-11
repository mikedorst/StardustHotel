
<!-- start: header -->
<header class="header">
    <nav class="fixed-top customNav">
		<div class="navText">
            <p class="navHeader">Stardust</p>
		</div>
        <div class="navLine"></div>
        <div>
            <div id="menuLinks">
                <a href="{{ route('home') }}"><span>Home</span></a>
                <a href="{{ route('rooms') }}"><span>Kamers</span></a>
                <a href="{{ route('contact') }}"><span>Contact</span></a>
				@if (Auth::check())
					@if(Auth()->user()->role != null && Auth()->user()->role > 0)
						<a href="{{ route('admin') }}"><span>Admin</span></a>
					@endif
					<a href="{{ route('bookings') }}"><span>Mijn Boekingen</span></a>
					<a href="{{ route('logout') }}"><span>Logout</span></a>
				@else
					<a href="{{ route('login') }}"><span>Login</span></a>
					<a href="{{ route('register') }}"><span>Registreer</span></a>
				@endif
            </div>
        </div>
        <div>

        </div>
    </nav>
</header>
<!-- end: header -->
