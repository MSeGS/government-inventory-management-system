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

        @if( $user->hasAnyAccess(array('indent.index', 'indent.create')) )
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Indent <b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if($user->hasAccess('indent.create') && !$user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('indent.create'))?'class="active"':''}}><a href="{{route('indent.create')}}"><?php echo _('New Indent');?></a></li>
                @endif
                <li><a href="/">Item 1</a></li>
                <li><a href="/">Item 1</a></li>
                <li><a href="/">Item 1</a></li>
                <li><a href="/">Item 1</a></li>
                <li><a href="/">Item 1</a></li>
                <li><a href="/">Item 1</a></li>
                <li><a href="/">Item 1</a></li>
                <li><a href="/">Item 1</a></li>
                <li><a href="/">Item 1</a></li>
            </ul>
        </li>
        @endif

        @if($user->hasAccess('indent.index') && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('indent.index'))?'class="active"':''}}><a href="{{route('indent.index')}}"><?php echo _('Indents');?></a></li>
        @endif

        @if($user->hasAccess('indent.mine') && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('indent.mine'))?'class="active"':''}}><a href="{{route('indent.mine')}}"><?php echo _('My Indent');?></a></li>
        @endif

        @if($user->hasAccess('indent.requirement') && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('indent.requirement'))?'class="active"':''}}><a href="{{route('indent.requirement')}}"><?php echo _('Requirements');?></a></li>
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
        
         @if( $user->hasAnyAccess(array('category.index', 'category.create')) )
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if($user->hasAccess('category.create') && !$user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('category.create'))?'class="active"':''}}><a href="{{route('category.create')}}"><?php echo _('New Category');?></a></li>
                @endif
                <li {{in_array(Route::currentRouteName(), array('category.index'))?'class="active"':''}}><a href="{{route('category.index')}}"><?php echo _('List Category') ?></a></li>
            </ul>
        </li>
        @endif
        
        @if($user->hasAccess('product.index') && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('product.index', 'product.edit'))?'class="active"':''}}><a href="{{url('/product')}}"><?php echo _('Products'); ?></a></li>
        @endif
        
        @if( $user->hasAnyAccess(array('stock.index', 'stock.create')) )
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Stock <b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if($user->hasAccess('stock.create') && !$user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('stock.create'))?'class="active"':''}}><a href="{{route('stock.create')}}"><?php echo _('New Stock');?></a></li>
                @endif
                <li {{in_array(Route::currentRouteName(), array('stock.index'))?'class="active"':''}}><a href="{{route('stock.index')}}"><?php echo _('List Stock') ?></a></li>
            </ul>
        </li>
        @endif
        
        @if( $user->hasAnyAccess(array('damage.index', 'damage.trash')) )
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Damage <b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if($user->hasAccess('damage.index') && !$user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('damage.index'))?'class="active"':''}}><a href="{{route('damage.index')}}"><?php echo _('Damage List');?></a></li>
                @endif
                @if($user->hasAccess('damage.create') && !$user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('damage.create'))?'class="active"':''}}><a href="{{route('damage.create')}}"><?php echo _('Damage Reports');?></a></li>
                @endif
                @if($user->hasAccess('damage.trash') && !$user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('damage.create'))?'class="active"':''}}><a href="{{route('damage.trash')}}"><?php echo _('Damage Trash');?></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($user->hasAccess('damage.manage') && !$user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('damage.manage'))?'class="active"':''}}><a href="{{route('damage.manage')}}"><?php echo _('Damage Report'); ?></a></li>
        @endif

        @if( $user->hasAnyAccess(array('message.index', 'message.create')) && !$user->isSuperUser())
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{get_unread_message_count()}} <?php  echo _('Message'); ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if($user->hasAccess('message.index') && !$user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('message.index'))?'class="active"':''}}><a href="{{route('message.index')}}"><?php echo _('Message Inbox');?></a></li>
                @endif
                @if($user->hasAccess('message.outbox') && !$user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('message.outbox'))?'class="active"':''}}><a href="{{route('message.outbox')}}"><?php echo _('Message Outbox');?></a></li>
                @endif
                @if($user->hasAccess('message.create') && !$user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('message.create'))?'class="active"':''}}><a href="{{route('message.create')}}"><?php echo _('Message Compose');?></a></li>
                @endif
                
            </ul>
        </li>
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