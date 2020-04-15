@extends('layouts.app')
@section('content')
<!-- Filter form section -->
<div class="filter-search">
	<div class="container">
		<form class="filter-form">
			<input type="text" placeholder="Enter a street name, address number or keyword">
			<select>
				<option value="City">City</option>
			</select>
			<select>
				<option value="City">State</option>
			</select>
			<button class="site-btn fs-submit">SEARCH</button>
		</form>
	</div>
</div>
<!-- Filter form section end -->

<!-- Properties section -->
<section class="properties-section spad">
	<div class="container">
		<div class="section-title text-center">
			<h3>RECENT PROPERTIES</h3>
			<p>Discover how much the latest properties have been sold for</p>
		</div>
		<div class="row">
		@if(count($properties) > 0)
			@foreach($properties->take(4) as $property)
				<div class="col-md-6">
					<div class="propertie-item set-bg" data-setbg="/storage/photos/{{$property->photo}}">
						<div class="{{$property->rent_sale === 'sale' ? 'sale-notic' :'rent-notic'}} ">For {{$property->rent_sale}}</div>
						<div class="propertie-info text-white">
							<div class="info-warp">
								<h5>{{$property->city->name}}</h5>
								<p><i class="fa fa-map-marker"></i>{{$property->address}}</p>
							</div>
							<div class="price"><a href="/property/{{$property->id}}">${{$property->price}}{{$property->rent_sale === 'rent' ? ' / Month' : ''}}</a></div>
						</div>
					</div>
				</div>
			@endforeach
		@else
			<h3>No Properties Yet</h3>
		@endif
		</div>
	</div>
</section>
<!-- Properties section end -->


<!-- Services section -->
<section class="services-section spad set-bg" data-setbg="css/img/service-bg.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<img src="css/img/service.jpg" alt="">
			</div>
			<div class="col-lg-5 offset-lg-1 pl-lg-0">
				<div class="section-title text-white">
					<h3>OUR SERVICES</h3>
					<p>We provide the perfect service for </p>
				</div>
				<div class="services">
					<div class="service-item">
						<i class="fa fa-comments"></i>
						<div class="service-text">
							<h5>Consultant Service</h5>
							<p>In Aenean purus, pretium sito amet sapien denim consectet sed urna placerat sodales magna leo.</p>
						</div>
					</div>
					<div class="service-item">
						<i class="fa fa-home"></i>
						<div class="service-text">
							<h5>Properties Management</h5>
							<p>In Aenean purus, pretium sito amet sapien denim consectet sed urna placerat sodales magna leo.</p>
						</div>
					</div>
					<div class="service-item">
						<i class="fa fa-briefcase"></i>
						<div class="service-text">
							<h5>Renting and Selling</h5>
							<p>In Aenean purus, pretium sito amet sapien denim consectet sed urna placerat sodales magna leo.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Services section end -->


<!-- feature section -->

<section class="feature-section spad">
	<div class="container">
		<div class="section-title text-center">
			<h3>Featured Listings</h3>
			@if(count($properties) > 0)
			<p>Browse houses and flats for sale and to rent in your area</p>
			</div>
			<div class="row">
			@foreach($properties as $property)
				<div class="col-lg-4 col-md-6">
					<!-- feature -->
					<div class="feature-item">
						<div class="feature-pic set-bg" data-setbg="/storage/photos/{{$property->photo}}">
							<div class="{{$property->rent_sale === 'sale' ? 'sale-notic' : 'rent-notic'}}">FOR {{$property->rent_sale === 'sale' ? 'sale' : 'rent'}}</div>
						</div>
						<div class="feature-text">
							<div class="text-center feature-title">
								<h5>{{$property->address}}</h5>
								<p><i class="fa fa-map-marker"></i> {{$property->city->name}}</p>
							</div>
							<div class="room-info-warp">
								<div class="room-info">
									<div class="rf-left">
										<p><i class="fa fa-th-large"></i> {{$property->square}} Square foot</p>
										<p><i class="fa fa-bed"></i> {{$property->bedroom}} Bedrooms</p>
									</div>
									<div class="rf-right">
										<p><i class="fa fa-car"></i> {{$property->garage}} Garages</p>
										<p><i class="fa fa-bath"></i> {{$property->bathroom}} Bathrooms</p>
									</div>	
								</div>
								<div class="room-info">
									<div class="rf-left">
										<p><i class="fa fa-user"></i> {{$property->user->name}}</p>
									</div>
									<div class="rf-right">
										<p><i class="fa fa-clock-o"></i> {{$property->created_at->format("Y-m-d")}}</p>
									</div>	
								</div>
								@if(!Auth::guest())
									@if(Auth::user()->id === $property->user->id)
									<div class="room-info">
										<div class="rf-left">
											<p><a href="property/{{$property->id}}/edit" class="btn btn-primary">EDIT</a></p>
										</div>
										<div class="rf-right">
											<p>
												{{Form::open(['action' =>['PropertiesController@destroy' , $property->id] , 'method' => 'POST'])}}
													{{Form::hidden('_method' , 'DELETE')}}
													{{Form::submit('Delete' , ['class' => 'btn btn-danger'])}}
												{{Form::close()}}
											</p>
										</div>	
									</div>
									@endif
								@endif
							</div>
							<a href="/property/{{$property->id}}" class="room-price">${{$property->price}}{{$property->rent_sale === 'rent' ? ' / Month' : ''}}</a>
						</div>
					</div>
				</div>
			@endforeach
			</div>
			@else
			<p>No Properties Yet!s</p>
			@endif
			@if(count($properties) > 9)
			<div class="row">
				<div class="col-4">
				</div>
				<div class="feature-item col-4">
					<a href="/property" class="btn room-price ">All Properties</a>
				</div>
				<div class="col-4">
				</div>
			</div>
			@endif
	</div>
</section>
<!-- feature section end -->



<!-- feature category section -->
<section class="feature-category-section spad">
	<div class="container">
		<div class="section-title text-center">
			<h3>LOOKING PROPERTY</h3>
			<p>What kind of property are you looking for? We will help you</p>
		</div>
		<div class="row">
			@forelse($kinds as $kind)
				<div class="col-lg-3 col-md-6 f-cata">
					<a href="#">
						<img src="css/img/feature-cate/1.jpg" alt="">
						<h5>{{$kind->name}}</h5>
					</a>
				</div>
			@empty
				<p class="text-center-danger">No Kinds Yet!</p>
			@endforelse
		</div>
	</div>
</section>
<!-- feature category section end-->


<!-- Gallery section -->
<section class="gallery-section spad">
	<div class="container">
		<div class="section-title text-center">
			<h3>Popular Places</h3>
			<p>We understand the value and importance of place</p>
		</div>
		<div class="gallery">
			<div class="grid-sizer"></div>
			@forelse($cities as $city)
				<a href="/property?city={{$city->name}}" class="gallery-item  set-bg" data-setbg="css/img/gallery/1.jpg">
					<div class="gi-info">
						<h3>{{$city->name}}</h3>
						<p>{{count($city->properties)}}</p>
					</div>
				</a>
			@empty
				<p class="text-center-danger">No Citites add!</p>
			@endforelse
			
		</div>
	</div>
</section>
<!-- Gallery section end -->



<!-- Review section -->
<section class="review-section set-bg" data-setbg="css/img/review-bg.jpg">
	<div class="container">
		<div class="review-slider owl-carousel">
			<div class="review-item text-white">
				<div class="rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
				</div>
				<p>“Leramiz was quick to understand my needs and steer me in the right direction. Their professionalism and warmth made the process of finding a suitable home a lot less stressful than it could have been. Thanks, agent Tony Holland.”</p>
				<h5>Stacy Mc Neeley</h5>
				<span>CEP’s Director</span>
				<div class="clint-pic set-bg" data-setbg="css/img/review/1.jpg"></div>
			</div>
			<div class="review-item text-white">
				<div class="rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
				</div>
				<p>“Leramiz was quick to understand my needs and steer me in the right direction. Their professionalism and warmth made the process of finding a suitable home a lot less stressful than it could have been. Thanks, agent Tony Holland.”</p>
				<h5>Stacy Mc Neeley</h5>
				<span>CEP’s Director</span>
				<div class="clint-pic set-bg" data-setbg="css/img/review/1.jpg"></div>
			</div>
			<div class="review-item text-white">
				<div class="rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
				</div>
				<p>“Leramiz was quick to understand my needs and steer me in the right direction. Their professionalism and warmth made the process of finding a suitable home a lot less stressful than it could have been. Thanks, agent Tony Holland.”</p>
				<h5>Stacy Mc Neeley</h5>
				<span>CEP’s Director</span>
				<div class="clint-pic set-bg" data-setbg="css/img/review/1.jpg"></div>
			</div>
		</div>
	</div>
</section>
<!-- Review section end-->


<!-- Blog section -->
<section class="blog-section spad">
	<div class="container">
		<div class="section-title text-center">
			<h3>LATEST NEWS</h3>
			<p>Real estate news headlines around the world.</p>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-6 blog-item">
				<img src="css/img/blog/1.jpg" alt="">
				<h5><a href="single-blog.html">Housing confidence hits record high as prices skyrocket</a></h5>
				<div class="blog-meta">
					<span><i class="fa fa-user"></i>Amanda Seyfried</span>
					<span><i class="fa fa-clock-o"></i>25 Jun 201</span>
				</div>
				<p>Integer luctus diam ac scerisque consectetur. Vimus dotnetact euismod lacus sit amet. Aenean interdus mid vitae maximus...</p>
			</div>
			<div class="col-lg-4 col-md-6 blog-item">
				<img src="css/img/blog/2.jpg" alt="">
				<h5><a href="single-blog.html">Taylor Swift is selling her $2.95 million Beverly Hills mansion</a></h5>
				<div class="blog-meta">
					<span><i class="fa fa-user"></i>Amanda Seyfried</span>
					<span><i class="fa fa-clock-o"></i>25 Jun 201</span>
				</div>
				<p>Integer luctus diam ac scerisque consectetur. Vimus dotnetact euismod lacus sit amet. Aenean interdus mid vitae maximus...</p>
			</div>
			<div class="col-lg-4 col-md-6 blog-item">
				<img src="css/img/blog/3.jpg" alt="">
				<h5><a href="single-blog.html">NYC luxury housing market saturated with inventory, says celebrity realtor</a></h5>
				<div class="blog-meta">
					<span><i class="fa fa-user"></i>Amanda Seyfried</span>
					<span><i class="fa fa-clock-o"></i>25 Jun 201</span>
				</div>
				<p>Integer luctus diam ac scerisque consectetur. Vimus dotnetact euismod lacus sit amet. Aenean interdus mid vitae maximus...</p>
			</div>
		</div>
	</div>
</section>
<!-- Blog section end -->

@endsection