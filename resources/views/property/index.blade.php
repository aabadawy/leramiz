@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<div class="site-breadcrumb">
    <div class="container">
        <a href=""><i class="fa fa-home"></i>Home</a>
        <span><i class="fa fa-angle-right"></i>Featured Listings</span>
    </div>
</div>


<!-- page -->
<section class="page-section categories-page">
    <div class="container">
        <div class="row">
            @forelse($properties as $property)
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
                                        <p><i class="fa fa-car"></i> {{$property->garages}} Garages</p>
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
            @empty
                <p>NO properties Yet!</p>
            @endforelse
        </div>
        <div class="site-pagination">
            {{$properties->render()}}</div>
    </div>
</section>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/main.js"></script>
<!-- page end -->
@endsection