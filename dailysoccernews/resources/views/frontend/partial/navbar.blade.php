	<header>
		<div class="container-fluid position-relative no-side-padding">

			<a href="{{route('frontend-home')}}" class="logo text-bold">
				<!-- <img src="{{asset('frontend/images/logo.png')}}" alt="Logo Image"> -->
				BLOG
			</a>

			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

			<ul class="main-menu visible-on-click" id="main-menu">
				<li><a href="{{route('frontend-home')}}" class="{{Request::is('/')?'url-active':''}}">Home</a></li>
				<li>
					<a href="{{route('frontend-blog')}}" title="Blog" class="{{Route::is('frontend-blog')?'url-active':''}}">
						Blog
					</a>
				</li>
				
				
				<li>
					<a href="{{route('Contact')}}" title="Blog" class="{{Route::is('Contact')?'url-active':''}}">
						Contact
					</a>
				</li>
				@guest
				<li><a href="{{url('/login')}}">Login</a></li>
				<li><a href="{{url('/register')}}">Register</a></li>
				@else
					@if(Auth::user()->role->id=1)
					<li><a href="{{url('/admin/dashboard')}}" title="Dashboard">Dashboard</a></li>
					@else
					<li><a href="{{url('/author/dashboard')}}" title="Dashboard">Dashboard</a></li>
					@endif
				@endguest
			</ul><!-- main-menu -->

			<div class="src-area">
				<form action="{{url('/search')}}" method="get">
					<button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
					<input class="src-input" type="text" placeholder="Type of search" name="query" required="" value="{{isset($query) ? $query : ''}}">
				</form>
			</div>

		</div><!-- conatiner -->
	</header>