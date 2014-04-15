<div class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        @if(Sentry::check())
        
        <?php
        $user = Sentry::getUser();
        $super = Sentry::findGroupByName('Super Administrator');
        $admin = Sentry::findGroupByName('Administrator');
        $indentor = Sentry::findGroupByName('Indentor');
        $store_keeper = Sentry::findGroupByName('Store Keeper');
        ?>

        @if($user->hasAccess('home.index'))
        <li {{Request::path() == '/'?'class="active"':''}}><a href="{{route('home.index')}}">Main</a></li>
        @endif

        @if($user->hasAccess('store.index') && $user->isSuperUser())
        <li {{Request::path() == 'store'?'class="active"':''}}><a href="{{route('store.index')}}">Stores</a></li>
        @endif

        @if($user->hasAccess('user.index'))
        <li {{Request::path() == 'user'?'class="active"':''}}><a href="{{url('/user')}}">Users</a></li>
        @endif
        
        @if($user->hasAccess('group.index'))
        <li {{Request::path() == 'group'?'class="active"':''}}><a href="{{url('/group')}}">Groups</a></li>
        @endif
        
        @if($user->hasAccess('resource.index'))
        <li {{Request::path() == 'resource'?'class="active"':''}}><a href="{{url('/resource')}}">Resource</a></li>
        @endif
        
        @if($user->hasAccess('option.index'))
        <li {{Request::path() == 'option'?'class="active"':''}}><a href="{{url('/option')}}">Options</a></li>
        @endif
        
        @if($user->hasAccess('department.index'))
        <li {{Request::path() == 'department'?'class="active"':''}}><a href="{{url('/department')}}">Department</a></li>
        @endif

        @if($user->hasAccess('setting.index') && !$user->isSuperUser())
        <li {{Request::path() == 'setting'?'class="active"':''}}><a href="{{url('/setting')}}">Settings</a></li>
        @endif
        
        @if($user->hasAccess('category.index') && !$user->isSuperUser())
        <li {{Request::path() == 'category'?'class="active"':''}}><a href="{{url('/category')}}">Categories</a></li>
        @endif
        
        @if($user->hasAccess('product.index') && !$user->isSuperUser())
        <li {{Request::path() == 'product'?'class="active"':''}}><a href="{{url('/product')}}">Products</a></li>
        @endif
        
        @if($user->hasAccess('stock.index') && !$user->isSuperUser())
        <li {{Request::path() == 'stock'?'class="active"':''}}><a href="{{url('/stock')}}">Stocks</a></li>
        @endif

        @if($user->hasAccess('damage.index') && !$user->isSuperUser())
        <li {{Request::path() == 'damage'?'class="active"':''}}><a href="{{url('/damage')}}">Damage</a></li>
        @endif
        
        @if($user->hasAccess('logout'))
        <li {{Request::path() == 'logout'?'class="active"':''}}><a href="{{url('/logout')}}">Sign Out</a></li>
        @endif

        @else
        <li {{Request::path() == 'login'?'class="active"':''}}><a href="{{url('/login')}}">Sign In</a></li>
        <li {{Request::path() == 'registration'?'class="active"':''}}><a href="{{url('/registration')}}">Registration</a></li>
        <li {{Request::path() == 'help'?'class="active"':''}}><a href="{{url('/help')}}">Help</a></li>
        @endif
    </ul>
</div><!--/.nav-collapse -->