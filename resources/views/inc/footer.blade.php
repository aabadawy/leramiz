<!-- Footer section -->
@php
	$cities = App\Models\City::orderBy('number_of_properties' , 'desc')->get();
@endphp
<footer class="footer-section set-bg" data-setbg="{{asset('css/img/footer-bg.jpg')}}">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 footer-widget">
				<div class="contact-widget">
					<h5 class="fw-title">CONTACT US</h5>
					<p><i class="fa fa-map-marker"></i>3711-2880 Nulla St, Mankato, Mississippi </p>
					<p><i class="fa fa-phone"></i>(+88) 666 121 4321</p>
					<p><i class="fa fa-envelope"></i>info.leramiz@colorlib.com</p>
					<p><i class="fa fa-clock-o"></i>Mon - Sat, 08 AM - 06 PM</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 footer-widget">
				<div class="double-menu-widget">
					<h5 class="fw-title">POPULAR PLACES</h5>
						<ul>
							@foreach($cities->take(4) as $city)
								<li><a href="/property?city={{$city->name}}">{{$city->name}}</a></li>
							@endforeach
							@if(count($cities) >= 4)
								<li> <b> <a id="all_cities" class="btn btn-success" data-toggle="modal" data-target=".all_cities"> See all</a></b></li>
							@endif
						</ul>
				</div>
			</div>
			<div class="col-lg-4 col-md-6  footer-widget">
				<div class="newslatter-widget">
					<h5 class="fw-title">NEWSLETTER</h5>
					<p>Subscribe your email to get the latest news and new offer also discount</p>
					<form class="footer-newslatter-form">
						<input type="text" placeholder="Email address">
						<button><i class="fa fa-send"></i></button>
					</form>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="footer-nav">
				<ul>
					<li><a href="/">Home</a></li>
					<li><a href="/property">All Properties</a></li>
					<li><a href="#">About us</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</div>
			<div class="copyright">
				<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
			</div>
		</div>
	</div>
</footer>
<div class="modal fade all_cities" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<ul class="list-group">
			@foreach($cities as $city)
				<li class="list-group-item text-center"><a href="/property?city={{$city->name}}" class=" text-success">{{$city->name}}</a></li>
			@endforeach
			</ul>
		</div>
	</div>
</div>
<!-- Footer section end -->