@if(count($cities) == 4)
    <a href="/property?city={{$cities[0]->name}}" class="gallery-item grid-long set-bg" data-setbg="/storage/{{$cities[0]->image}}">
        <div class="gi-info">
            <h3>{{$cities[0]->name}}</h3>
            <p>{{$cities[0]->number_of_properties}}</p>
        </div>
    </a>
    <a href="/property?city={{$cities[1]->name}}" class="gallery-item grid-wide set-bg" data-setbg="/storage/{{$cities[1]->image}}">
        <div class="gi-info">
            <h3>{{$cities[1]->name}}</h3>
            <p>{{$cities[1]->number_of_properties}}</p>
        </div>
    </a>
    <a href="/property?city={{$cities[2]->name}}" class="gallery-item set-bg"  data-setbg="/storage/{{$cities[2]->image}}">
        <div class="gi-info">
            <h3>{{$cities[2]->name}}</h3>
            <p>{{$cities[2]->number_of_properties}}</p>
        </div>
    </a>
    <a href="/property?city={{$cities[0]->name}}" class="gallery-item set-bg"  data-setbg="/storage/{{$cities[3]->image}}">
        <div class="gi-info">
            <h3>{{$cities[3]->name}}</h3>
            <p>{{$cities[3]->number_of_properties}}</p>
        </div>
    </a>
@elseif(count($cities) == 3)
    <a href="/property?city={{$cities[0]->name}}" class="gallery-item grid-long set-bg" data-setbg="/storage/{{$cities[0]->image}}">
        <div class="gi-info">
            <h3>{{$cities[0]->name}}</h3>
            <p>{{$cities[0]->number_of_properties}}</p>
        </div>
    </a>
    <a href="/property?city={{$cities[1]->name}}" class="gallery-item grid-wide set-bg" data-setbg="/storage/{{$cities[1]->image}}">
        <div class="gi-info">
            <h3>{{$cities[1]->name}}</h3>
            <p>{{$cities[1]->number_of_properties}}</p>
        </div>
    </a>
    <a href="/property?city={{$cities[2]->name}}" class="gallery-item grid-long set-bg"  data-setbg="/storage/{{$cities[2]->image}}">
        <div class="gi-info">
            <h3>{{$cities[2]->name}}</h3>
            <p>{{$cities[2]->number_of_properties}}</p>
        </div>
    </a>

@elseif(count($cities) == 2)
    <a href="/property?city={{$cities[0]->name}}" class="gallery-item grid-wide set-bg" data-setbg="/storage/{{$cities[0]->image}}">
        <div class="gi-info">
            <h3>{{$cities[0]->name}}</h3>
            <p>{{$cities[0]->number_of_properties}}</p>
        </div>
    </a>
    <a href="/property?city={{$cities[1]->name}}" class="gallery-item grid-wide set-bg" data-setbg="/storage/{{$cities[1]->image}}">
        <div class="gi-info">
            <h3>{{$cities[1]->name}}</h3>
            <p>{{$cities[1]->number_of_properties}}</p>
        </div>
    </a>
@elseif(count($cities) == 1)
    <a href="/property?city={{$cities[0]->name}}" class="gallery-item grid-wide set-bg" data-setbg="/storage/{{$cities[0]->image}}">
        <div class="gi-info">
            <h3>{{$cities[0]->name}}</h3>
            <p>{{$cities[0]->number_of_properties}}</p>
        </div>
    </a>
@else
    <p class="text-center-danger">No Citites add!</p>
@endif
