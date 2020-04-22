<!-- This file is used to store topbar (left) items -->
@if(!auth()->guest())
    @if (auth()->user()->roles->contains('name' , 'Admin') ||
        auth()->user()->roles->contains('name' , 'Data Entry')) 
{{-- <li class="nav-item px-3"><a class="nav-link" href="#">Dashboard</a></li>
<li class="nav-item px-3"><a class="nav-link" href="#">Users</a></li>
<li class="nav-item px-3"><a class="nav-link" href="#">Settings</a></li> --}}
    @endif
@endif