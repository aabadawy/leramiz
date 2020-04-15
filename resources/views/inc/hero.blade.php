<!-- Hero section -->
<section class="hero-section set-bg" data-setbg="{{asset('css/img/bg.jpg')}}">
		<div class="container hero-text text-white">
			@guest	
			<h2>find your place with our local life style</h2>
			<p>Search real estate property records, houses, condos, land and more on leramiz.com®.<br>Find property info from the most comprehensive source data.</p>
			<a href="/register" class="site-btn">Create Account</a>
			@else
			 <h3>Welcome Back {{Auth::user()->name}}</h3>
			<p>Search real estate property records, houses, condos, land and more on leramiz.com®.<br>Find property info from the most comprehensive source data.</p>
			 <a href="{{Auth::user()->email}}" class="site-btn">My Profile</a>
			@endguest
		</div>
</section>
<!-- Hero section end -->