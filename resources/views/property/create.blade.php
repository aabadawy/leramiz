@php 
    $details = App\Models\Detail::all()->pluck('name' , 'id');
    $cities = App\Models\City::all()->pluck('name' , 'id');
    $kinds = App\Models\Kind::all()->pluck('name' , 'id');
@endphp
<div class="site-breadcrumb">
    <div class="container">
    </div>
</div>
<!--  Page top end -->
<div class="container text-center col-6">
    {{ Form::open(['action' => 'PropertiesController@store', 'files' => true  , 'method' => 'POST']) }}
        <div class="row">
                <div class="form-group col-4">
                    {{Form::label('square' , 'Square')}}
                    {{Form::number('square' , '' , ['class' => 'form-control' , 'placeholder' => 'e.x 250 squre foot'])}}
                    @error('square')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-4">
                    {{Form::label('bathroom' , 'Bathroom/s')}}
                    {{Form::number('bathroom' , '' , ['class' => 'form-control' , 'placeholder' => 'e.x 2 Bathrooms'])}}
                    @error('bathroom')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-4">
                    {{Form::label('bedroom' , 'Bedroom/s')}}
                    {{Form::number('bedroom' , '' , ['class' => 'form-control' , 'placeholder' => 'e.x 3 Bedrooms'])}}
                    @error('bedroom')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-4">
                    {{Form::label('garage' , 'Garage/s')}}
                    {{Form::number('garage' , '' , ['class' => 'form-control' , 'placeholder' => 'e.x 7 Garages'])}}
                    @error('garage')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-4">
                    {{Form::label('kind_id' , 'Kind')}}
                    {{Form::select('kind_id' , $kinds,'' , ['class' => 'form-control' ])}}
                    @error('kind_id')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-4">
                    {{Form::label('old' , 'Build Form')}}
                    {{Form::number('old' , '' , ['class' => 'form-control' , 'placeholder' => 'e.x 9 years'])}}
                    @error('old')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-4">
                    {{Form::label('city_id' , 'City')}}
                    {{Form::select('city_id' , $cities , '' , ['class' => 'form-control'])}}
                    @error('city_id')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-8">
                    {{Form::label('address' , 'Address')}}
                    {{Form::text('address' , '' , ['class' => 'form-control' , 'placeholder' => 'e.x 15 Army St in front of fatahalla, Al abrahmya'])}}
                    @error('address')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-4">
                    {{Form::label('details' , 'Details')}}
                    {{Form::select('details[]' , $details ,null,array('multiple' => true) , ['class' => 'form-control'])}}
                    @error('details')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                    @error('details')
                        <div class="text-danger text-xs">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group col-4">
                    {{Form::label('price' , 'price')}}
                    {{Form::number('price' , '' , ['class' => 'form-control' ,'placeholder' => 'e.x 2,500,000 $'])}}
                    @error('price')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-4">
                    {{Form::label('rent_sale' , 'Rent Or Sale')}}
                    {{Form::select('rent_sale' , ['rent' => 'Rent' , 'sale' => 'Sale'],'' , ['class' => 'form-control' ])}}
                </div>
                <div class="form-group col-12">
                    {{Form::file('image',[] )}}
                    @error('image')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-12">
                    {{Form::label('description' , 'description')}}
                    {{Form::textarea('description' , '' , ['class' => 'form-control' , 'placeholder' => 'Try To Descripte It Emotional'])}}
                    @error('description')
                        <p class="text-danger text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div  class="form-group col-4 "></div>
                <div class="form-group col-4 ">
                    {{Form::submit('Submit' , ['class' => 'form-control btn btn-primary'])}}
                </div>
                <div  class="form-group col-4 "></div>
        </div>
    {!! Form::close() !!}
    <!-- $table->integer('square');
            $table->integer('garage');
            $table->integer('bathroom');
            $table->integer('bedroom');
            $table->string('kind');
            $table->integer('old');
            $table->text('description');
            $table->string('city');
            $table->string('address');
            $table->integer('price');
            $table->string('rent_sale'); -->
</dvi>
<script src="{{asset('js/main.js')}}"></script>