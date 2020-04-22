<!-- This file is used to store topbar (right) items -->
@if(!auth()->guest())
    @if (auth()->user()->roles->contains('name' , 'Admin') ||
        auth()->user()->roles->contains('name' , 'Data Entry')) 
{{-- <li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="fa fa-bell"></i><span class="badge badge-pill badge-danger">5</span></a></li>
<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="fa fa-list"></i></a></li>
<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="fa fa-map"></i></a></li> --}}
    @endif
@endif