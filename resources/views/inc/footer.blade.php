<!-- Footer section -->
@php
	$cities = App\City::all();
@endphp
<footer class="footer-section set-bg" data-setbg="{{asset('css/img/footer-bg.jpg')}}">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 footer-widget">
				<img src="img/logo.png" alt="">
				<p>Lorem ipsum dolo sit azmet, consecter dipise consult  elit. Maecenas mamus antesme non anean a dolor sample tempor nuncest erat.</p>
				<div class="social">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-instagram"></i></a>
					<a href="#"><i class="fa fa-pinterest"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 footer-widget">
				<div class="contact-widget">
					<h5 class="fw-title">CONTACT US</h5>
					<p><i class="fa fa-map-marker"></i>3711-2880 Nulla St, Mankato, Mississippi </p>
					<p><i class="fa fa-phone"></i>(+88) 666 121 4321</p>
					<p><i class="fa fa-envelope"></i>info.leramiz@colorlib.com</p>
					<p><i class="fa fa-clock-o"></i>Mon - Sat, 08 AM - 06 PM</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 footer-widget">
				<div class="double-menu-widget">
					<h5 class="fw-title">POPULAR PLACES</h5>
						<ul>
							@foreach($cities->take(4) as $city)
								<li><a href="/property?city={{$city->name}}">{{$city->name}}</a></li>
							@endforeach
							<li> <b> <a href="#" class="btn btn-success"> See all</a></b></li>
						</ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-6  footer-widget">
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
					<li><a href="">Home</a></li>
					<li><a href="">Featured Listing</a></li>
					<li><a href="">About us</a></li>
					<li><a href="">Pages</a></li>
					<li><a href="">Blog</a></li>
					<li><a href="">Contact</a></li>
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

<!-- Footer section end -->