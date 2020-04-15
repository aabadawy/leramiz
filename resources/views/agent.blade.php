@extends('layouts.app')

@section('content')
@include('property.create')
<div class="site-breadcrumb">
    <div class="container">
    </div>
</div>
<!--  Page top end -->

<!-- feature section -->
<section class="feature-section spad">
	<div class="container">
		<div class="section-title text-center">
			<h3>Featured Listings</h3>
			<p>All Your Properties Will be here</p>
		</div>
		<div class="row">
@forelse($user->properties as $property)
        <div class="col-lg-4 col-md-6">
            <!-- feature -->
            <div class="feature-item">
                <div class="feature-pic set-bg" data-setbg="/storage/photos/{{$property->photo}}">
                    <div class="{{$property->rent_sale === 'sale' ? 'sale-notic' :'rent-notic'}}">For {{$property->rent_sale}}</div>
                </div>
                <div class="feature-text">
                    <div class="text-center feature-title">
                        <h5>{{$property->address}}</h5>
                        <p><i class="fa fa-map-marker"></i>{{$property->city}}</p>
                    </div>
                    <div class="room-info-warp">
                        <div class="room-info">
                            <div class="rf-left">
                                <p><i class="fa fa-th-large"></i>{{$property->square}} Square foot</p>
                                <p><i class="fa fa-bed"></i>{{$property->bedroom}} Bedrooms</p>
                            </div>
                            <div class="rf-right">
                                <p><i class="fa fa-car"></i>{{$property->garage}} Garages</p>
                                <p><i class="fa fa-bath"></i>{{$property->bathroom}} bathrooms</p>
                            </div>	
                        </div>
                        <div class="room-info">
                            <div class="rf-left">
                                <p><i class="fa fa-user"></i>{{Auth::user()->name}}</p>
                            </div>
                            <div class="rf-right">
                                <p><i class="fa fa-clock-o"></i> {{$property->created_at->format("d-M-Y")}}</p>
                            </div>	
                        </div>
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
                    </div>
                    <a href="/property/{{$property->id}}" class="room-price">${{$property->price}}{{$property->rent_sale === 'rent' ? ' / Month' : ''}}</a>
                </div>
            </div>
        </div>
@empty
    <h2 class="text-danger col-12">You dont have any properties Yet :( !</h2>
@endforelse

        </div>
	</div>
</section>
<!-- feature section end -->
<div class="site-breadcrumb">
    <div class="container">
    </div>
</div>

<!--====== Javascripts & Jquery ======-->
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/masonry.pkgd.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@endsection