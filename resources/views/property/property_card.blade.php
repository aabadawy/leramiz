<div class="col-lg-4 col-md-6">
    <!-- feature -->
    <div class="feature-item">
        <div class="feature-pic set-bg" data-setbg="/storage/{{$property->image}}">
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
                                {{Form::open(['action' =>['PropertiesController@destroy' , $property->id] , 'method' => 'POST'])}}
                                    {{Form::hidden('_method' , 'DELETE')}}
                                    {{Form::submit('Delete' , ['class' => 'btn btn-danger'] )}}
                                {{Form::close()}}
                        </div>	
                    </div>
                    @endif
                @endif
            </div>
            <a href="/property/{{$property->id}}" class="room-price">${{$property->price}}{{$property->rent_sale === 'rent' ? ' / Month' : ''}}</a>
        </div>
    </div>
</div>