<!-- Header section -->
<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 header-top-left">
						<div class="top-info">
							@if(!Auth::guest())
							<a href="/{{Auth::user()->email}}"> <h3 class="text-success">{{Auth::user()->name}}</b></h3>
							
							@endif
						</div>
					</div>
					<div class="col-lg-6 text-lg-right header-top-right">
						<div class="top-social">
							<a href=""><i class="fa fa-facebook"></i></a>
							<a href=""><i class="fa fa-twitter"></i></a>
							<a href=""><i class="fa fa-instagram"></i></a>
							<a href=""><i class="fa fa-pinterest"></i></a>
							<a href=""><i class="fa fa-linkedin"></i></a>
						</div>
							<div class="user-panel navbar navbar-expand-md ">
								<div class="collapse navbar-collapse" >
									<!-- Left Side Of Navbar -->

									<!-- Right Side Of Navbar -->
									<ul class="navbar-nav ml-auto">
										<!-- Authentication Links -->
										@guest
											<li class="nav-item">
												<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
											</li>
											@if (Route::has('register'))
												<li class="nav-item">
													<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
												</li>
											@endif
										@else
											<li class="nav-item ">
													<a class="nav-link" href="{{ route('logout') }}"
													onclick="event.preventDefault();
																	document.getElementById('logout-form').submit();">
														{{ __('Logout') }}
													</a>

													<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
														@csrf
													</form>
												</div>
											</li>
										@endguest
									</ul>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="site-navbar">
						<a href="/" class="site-logo"><img src="css/img/logo.png" alt=""></a>
						<div class="nav-switch">
							<i class="fa fa-bars"></i>
						</div>
						<ul class="main-menu">
							<li><a href="/">Home</a></li>
							<li><a href="/property">properties</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->