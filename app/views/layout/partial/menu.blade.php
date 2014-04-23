<div class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        @if(Sentry::check())
        
        <?php
        $user = Sentry::getUser();
        // $super = Sentry::findGroupByName('Super Administrator');
        // $admin = Sentry::findGroupByName('Administrator');
        // $indentor = Sentry::findGroupByName('Indentor');
        // $store_keeper = Sentry::findGroupByName('Store Keeper');
        ?>

        @if($user->hasAccess('home.index'))
        <li {{in_array(Route::currentRouteName(), array('home.index'))?'class="active"':''}}><a href="{{route('home.index')}}"><?php echo _('Main');?></a></li>
        @endif

        @if($user->hasAccess('store.index') && $user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('store.index'))?'class="active"':''}}><a href="{{route('store.index')}}"><?php echo _('Stores'); ?></a></li>
        @endif

        @if($user->hasAccess('user.index'))
        <li {{in_array(Route::currentRouteName(), array('user.index', 'user.edit'))?'class="active"':''}}><a href="{{route('user.index')}}"><?php echo _('Users'); ?></a></li>
        @endif

        @if($user->hasAccess('user.profile') && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('user.profile'))?'class="active"':''}}><a href="{{route('user.profile')}}"><?php echo _('Profile'); ?></a></li>
        @endif
        
        @if($user->hasAccess('group.index'))
        <li {{in_array(Route::currentRouteName(), array('group.index', 'group.edit'))?'class="active"':''}}><a href="{{route('group.index')}}"><?php echo _('Groups'); ?></a></li>
        @endif
        
        @if($user->hasAccess('resource.index'))
        <li {{in_array(Route::currentRouteName(), array('resource.index', 'resource.edit'))?'class="active"':''}}><a href="{{route('resource.index')}}"><?php  echo _('Resource'); ?></a></li>
        @endif
        
        @if($user->hasAccess('option.index'))
        <li {{in_array(Route::currentRouteName(), array('option.index', 'option.edit'))?'class="active"':''}}><a href="{{url('/option')}}"><?php echo _('Options'); ?></a></li>
        @endif
        
        @if($user->hasAccess('department.index'))
        <li {{in_array(Route::currentRouteName(), array('department.index', 'department.edit'))?'class="active"':''}}><a href="{{url('/department')}}"><?php echo _('Department'); ?></a></li>
        @endif

        @if($user->hasAccess('setting.index') && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('setting.index', 'setting.edit'))?'class="active"':''}}><a href="{{route('setting.index')}}"><?php echo _('Settings'); ?></a></li>
        @endif
        
        @if($user->hasAccess('category.index') && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('category.index', 'category.edit'))?'class="active"':''}}><a href="{{url('/category')}}"><?php echo _('Categories'); ?></a></li>
        @endif
        
        @if($user->hasAccess('product.index') && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('product.index', 'product.edit'))?'class="active"':''}}><a href="{{url('/product')}}"><?php echo _('Products'); ?></a></li>
        @endif
        
        @if($user->hasAccess('stock.index') && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('stock.index', 'stock.edit'))?'class="active"':''}}><a href="{{url('/stock')}}"><?php echo _('Stocks'); ?></a></li>
        @endif

        @if($user->hasAnyAccess(array('damage.index', 'damage.trash')) && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('damage.index', 'damage.edit'))?'class="active"':''}}><a href="{{url('/damage')}}"><?php echo _('Damage'); ?></a></li>
        @endif
        
        @if($user->hasAccess('damage.manage') && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('damage.manage'))?'class="active"':''}}><a href="{{route('damage.manage')}}"><?php echo _('Damage Report'); ?></a></li>
        @endif
       
        @if($user->hasAccess('logout'))
        <li {{in_array(Route::currentRouteName(), array('logout'))?'class="active"':''}}><a href="{{url('/logout')}}"><?php echo _('Sign Out'); ?></a></li>
        @endif

        @else
        <li {{in_array(Route::currentRouteName(), array('login'))?'class="active"':''}}><a href="{{url('/login')}}"><?php echo _('Sign In'); ?></a></li>
        <li {{in_array(Route::currentRouteName(), array('registration'))?'class="active"':''}}><a href="{{url('/registration')}}"><?php echo _('Registration'); ?></a></li>
        <li {{in_array(Route::currentRouteName(), array('help'))?'class="active"':''}}><a href="{{url('/help')}}"><?php echo _('Help'); ?></a></li>
        @endif
    </ul>
</div><!--/.nav-collapse -->