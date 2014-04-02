<div class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        <?php //echo $current_route; ?>
        @if(Sentry::check())
        
        <?php
        $user = Sentry::getUser();
        $super = Sentry::findGroupByName('Super Administrator');
        $admin = Sentry::findGroupByName('Administrator');
        $indentor = Sentry::findGroupByName('Indentor');
        $store_keeper = Sentry::findGroupByName('Store Keeper');
        ?>
        <li {{Request::path() == '/'?'class="active"':''}}><a href="{{url('/')}}">Main</a></li>
        
        @if($user->inGroup($super))
        <li {{Request::path() == 'store'?'class="active"':''}}><a href="{{url('/store')}}">Stores</a></li>
        <li {{Request::path() == 'user'?'class="active"':''}}><a href="{{url('/user')}}">Users</a></li>
        <li {{Request::path() == 'group'?'class="active"':''}}><a href="{{url('/group')}}">Groups</a></li>
        <li {{Request::path() == 'resource'?'class="active"':''}}><a href="{{url('/resource')}}">Resource</a></li>
        <li {{Request::path() == 'option'?'class="active"':''}}><a href="{{url('/option')}}">Options</a></li>

        @elseif($user->inGroup($admin))
        <li {{Request::path() == 'setting'?'class="active"':''}}><a href="{{url('/setting')}}">Settings</a></li>

        @elseif($user->inGroup($indentor))
        <li><a href="">TESt</a></li>

        @elseif($user->inGroup($store_keeper))
        <li><a href="">TESt</a></li>
        @endif

        <li {{Request::path() == 'logout'?'class="active"':''}}><a href="{{url('/logout')}}">Sign Out</a></li>
        @else
        <li {{Request::path() == 'login'?'class="active"':''}}><a href="{{url('/login')}}">Sign In</a></li>
        <li {{Request::path() == 'registration'?'class="active"':''}}><a href="{{url('/registration')}}">Registration</a></li>
        <li {{Request::path() == 'help'?'class="active"':''}}><a href="{{url('/help')}}">Help</a></li>
        @endif

    </ul>
</div><!--/.nav-collapse -->