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
                @include('property.property_card')
            @empty
                <p>NO properties Yet!</p>
            @endforelse
        </div>
        <div class="site-pagination">
            {{$properties->render()}}
        </div>
    </div>
</section>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/main.js"></script>
<!-- page end -->
@endsection