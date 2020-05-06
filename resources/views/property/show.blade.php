@extends('layouts.app')


@section('content')
<div class="site-breadcrumb">
    <div class="container">
    </div>
</div>
<!-- Page -->
<section class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 single-list-page">
                <div class="single-list-slider">
                    <div class="sl-item set-bg" data-setbg="/storage/{{$property->image}}">
                        <div class="{{$property->rent_sale === 'sale' ? 'sale-notic' : 'rent-notic'}}">For {{$property->rent_sale}}</div>
                        
                    </div>
                </div>
                <div class="single-list-content">
                    <div class="row">
                        <div class="col-xl-8 sl-title">
                            <h2>{{$property->address}}</h2>
                            <p><i class="fa fa-map-marker"></i>{{$property->city->name}}</p>
                        </div>
                        <div class="col-xl-4">
                            <a href="/property/{{$property->id}}" class="price-btn">${{$property->price}}{{$property->rent_sale === 'rent' ? ' / Month' : ''}}</a>
                        </div>
                    </div>
                    <h3 class="sl-sp-title">Property Details</h3>
                    <div class="row property-details-list">
                        <div class="col-md-4 col-sm-6">
                            <p><i class="fa fa-th-large"></i>{{$property->square}} Square foots</p>
                            <p><i class="fa fa-bed"></i> {{$property->bedrooms}} Bedrooms</p>
                            <p><i class="fa fa-user"></i> {{$property->user->name}}</p>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <p><i class="fa fa-car"></i> {{$property->garage}} Garages</p>
                            <p><i class="fa fa-building-o"></i> {{$property->kind->name}}</p>
                            <p><i class="fa fa-clock-o"></i> 1 days ago</p>
                        </div>
                        <div class="col-md-4">
                            <p><i class="fa fa-bath"></i> {{$property->bathroom}} Bathrooms</p>
                            <p><i class="fa fa-trophy"></i> {{$property->old}} years age</p>
                        </div>
                    </div>
                    <h3 class="sl-sp-title">Description</h3>
                    <div class="description">
                        <p>{{$property->description}}</p>
                    </div>
                    <h3 class="sl-sp-title">Property Details</h3>
                    <div class="row property-details-list">
                        @forelse($property->details as $detail)
                        <div class="col-md-4 col-sm-6">
                            <p><i class="fa fa-check-circle-o"></i> {{$detail->name}}</p>
                        </div>
                        @empty
                            <p class="text-center">No details to be mentioned Yet!</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- sidebar -->
            <div class="col-lg-4 col-md-7 sidebar">
                <div class="author-card">
                    <a href="/{{$property->user->email}}">
                        <img class="author-img set-bg" src="{{asset('css/img/author.jpg')}}" alt="$property->user->name">
                    </a>
                    <div class="author-info">
                        <h5><a href="/{{$property->user->email}}" class="text-success">{{$property->user->name}}</a></h5>
                        <p>Real Estate Agent</p>
                    </div>
                    <div class="author-contact">
                        <p><i class="fa fa-phone"></i>(567) 666 121 2233</p>
                        <p><i class="fa fa-envelope"></i>{{$property->user->email}}</p>
                    </div>
                </div>
                @if(!Auth::guest())
                    @if(Auth::user()->id != $property->user->id)
                    <div class="contact-form-card">
                        <h5>Do you have any question?</h5>
                        <form>
                            <textarea placeholder="Your question"></textarea>
                            <p class="text-danger text-xs text-center">It will be send with your register name & email</p>
                            <button id="send_email" type="button">SEND</button>
                        </form>
                    </div>
                    @endif
                    @else
                    <div class="contact-form-card">
                        <h5>Do you have any question?</h5>
                        <form>
                            <input type="text" placeholder="Your name">
                            <input type="text" placeholder="Your email">
                            <textarea placeholder="Your question"></textarea>
                            <button id="send_email" type="button">SEND</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Page end -->
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/masonry.pkgd.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>


<!-- load for map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0YyDTa0qqOjIerob2VTIwo_XVMhrruxo"></script>
<script src="js/map-2.js"></script>
<script>
$(document).ready(function(){
    $("#send_email").click(function(){
        alert("You sent Email!");
    });
});
</script>
@endsection()
