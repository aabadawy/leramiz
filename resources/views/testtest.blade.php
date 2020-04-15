<section class="gallery-section spad">
	<div class="container">
		<div class="section-title text-center">
			<h3>Popular Places</h3>
			<p>We understand the value and importance of place</p>
		</div>
		<div class="gallery">
			<div class="grid-sizer"></div>
			<a href="/property?city=Alexandria" class="gallery-item grid-long set-bg" data-setbg="css/img/gallery/1.jpg">
				<div class="gi-info">
					<h3>Alexandria</h3>
					<p>{{count(App\Property::all()->where('city_id' , 2))}}</p>
				</div>
			</a>
			<a href="/property?city=Cairo" class="gallery-item grid-wide set-bg" data-setbg="css/img/gallery/2.jpg">
				<div class="gi-info">
					<h3>Cairo</h3>
					<p>{{count(App\Property::all()->where('city_name' , 'Cairo'))}}</p>
				</div>
			</a>
			<a href="/property?city=Luxor" class="gallery-item set-bg" data-setbg="css/img/gallery/3.jpg">
				<div class="gi-info">
					<h3>Luxor</h3>
					<p>{{count(App\Property::all()->where('city_name' , 'Luxor'))}}</p>
				</div>
			</a>
			<a href="/property?city=Giza" class="gallery-item set-bg" data-setbg="css/img/gallery/4.jpg">
				<div class="gi-info">
					<h3>Giza</h3>
					<p>{{count(App\Property::all()->where('city_name' , 'Giza'))}}</p>
				</div>
			</a>
			
		</div>
	</div>
</section>