<div class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        
        @if(Sentry::check())
        <li {{Request::path() == 'logout'?'class="active"':''}}><a href="{{url('/logout')}}">Sign Out</a></li>
        @else
        <li {{Request::path() == 'login'?'class="active"':''}}><a href="{{url('/login')}}">Sign In</a></li>
        <li {{Request::path() == 'registration'?'class="active"':''}}><a href="{{url('/registration')}}">Registration</a></li>
        <li {{Request::path() == 'help'?'class="active"':''}}><a href="{{url('/help')}}">Help</a></li>
        @endif

    </ul>
</div><!--/.nav-collapse -->