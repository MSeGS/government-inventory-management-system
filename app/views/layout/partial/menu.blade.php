<div class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        
        @if(Auth::check())
        <li {{Request::path() == 'sign-out'?'class="active"':''}}><a href="{{url('/sign-out')}}">Sign Out</a></li>
        @else
        <li {{Request::path() == 'sign-in'?'class="active"':''}}><a href="{{url('/sign-in')}}">Sign In</a></li>
        <li {{Request::path() == 'registration'?'class="active"':''}}><a href="{{url('/registration')}}">Registration</a></li>
        <li {{Request::path() == 'help'?'class="active"':''}}><a href="{{url('/help')}}">Help</a></li>
        @endif

    </ul>
</div><!--/.nav-collapse -->