@extends('layouts.app')
@section('content')
<!-- Filter form section -->
<div class="filter-search">
	<div class="container">
		<form class="filter-form">
			<input type="text" placeholder="Enter a street name, address number or keyword">
			<select>
			@forelse($cities as $city)
			<option value="City">{{$city->name}}</option>
			@empty
			<option value="City">City</option>
			@endforelse
			</select>
			<select>
			@forelse($kinds as $kind)
			<option value="City">{{$kind->name}}</option>
			@empty
			<option value="Kind">Kind</option>
			@endforelse
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
					<div class="propertie-item set-bg" data-setbg="/storage/{{$property->image}}">
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





<!-- feature section -->

<section class="feature-section spad" >
	<div class="container">
		<div class="section-title text-center">
			<h3>Featured Listings</h3>
			@if(count($properties) > 0)
			<p>Browse houses and flats for sale and to rent in your area</p>
			</div>
			<div class="row">
			@foreach($properties->take(9) as $property)
				@include('property.property_card')
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
<section class="feature-category-section spad set-bg" data-setbg="css/img/service-bg.jpg">
	<div class="container">
		<div class="section-title text-center">
			<h3>LOOKING PROPERTY</h3>
			<p>What kind of property are you looking for? We will help you</p>
		</div>
		<div class="row">
			@forelse($kinds as $kind)
				<div class="col-lg-3 col-md-6 f-cata">
					<a href="#">
						<img src="/storage/{{$kind->image}}" alt="">
						<h5 class="text-primary">{{$kind->name}}</h5>
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
<section class="gallery-section spad set-bg">
	<div class="container">
		<div class="section-title text-center">
			<h3>Popular Places</h3>
			<p>We understand the value and importance of place</p>
		</div>
		<div class="gallery">
			<div class="grid-sizer"></div>
			@forelse($cities as $city)
				<a href="/property?city={{$city->name}}" class="gallery-item  set-bg" data-setbg="/storage/{{$city->image}}">
					<div class="gi-info">
						<h3>{{$city->name}}</h3>
						<p>{{$city->number_of_properties}}</p>
					</div>
				</a>
			@empty
				<p class="text-center-danger">No Citites add!</p>
			@endforelse
			
		</div>
	</div>
</section>
<!-- Gallery section end -->




@endsection