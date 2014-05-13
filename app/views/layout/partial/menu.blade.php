<div class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
        @if(Sentry::check())

        @if($current_user->hasAccess('home.index'))
        <li {{in_array(Route::currentRouteName(), array('home.index'))?'class="active"':''}}><a href="{{route('home.index')}}"><span class="hidden-xs visible-sm visible-md visible-lg"><i class="fa fa-home"></i></span><span class="visible-xs hidden-sm hidden-md hidden-lg"><i class="fa fa-home"></i> <?php echo _('Dashboard'); ?></span></a></li>
        @endif

        @if( $current_user->hasAnyAccess(array('indent.index', 'indent.create')) && !$current_user->isSuperUser() )
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Indent <b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if($current_user->hasAccess('indent.create') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('indent.create'))?'class="active"':''}}><a href="{{route('indent.create')}}"><?php echo _('New Indent');?></a></li>
                @endif

                @if($current_user->hasAccess('indent.index') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('indent.index'))?'class="active"':''}}><a href="{{route('indent.index')}}"><?php echo _('List Indents');?></a></li>
                @endif

                @if($current_user->hasAccess('indent.mine') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('indent.mine'))?'class="active"':''}}><a href="{{route('indent.mine')}}"><?php echo _('My Indent');?></a></li>
                @endif
            </ul>
        </li>
        @endif

        @if($current_user->hasAccess('store.index') && $current_user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('store.index'))?'class="active"':''}}><a href="{{route('store.index')}}"><?php echo _('Stores'); ?></a></li>
        @endif

        @if($current_user->hasAccess('user.index'))
        <li {{in_array(Route::currentRouteName(), array('user.index', 'user.edit'))?'class="active"':''}}><a href="{{route('user.index')}}"><?php echo _('Users'); ?></a></li>
        @endif

        @if($current_user->hasAccess('user.profile') && !$current_user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('user.profile'))?'class="active"':''}}><a href="{{route('user.profile')}}"><?php echo _('Profile'); ?></a></li>
        @endif
                
        @if($current_user->hasAccess('option.index'))
        <li {{in_array(Route::currentRouteName(), array('option.index', 'option.edit'))?'class="active"':''}}><a href="{{url('/option')}}"><?php echo _('Options'); ?></a></li>
        @endif
        
        @if($current_user->hasAccess('department.index'))
        <li {{in_array(Route::currentRouteName(), array('department.index', 'department.edit'))?'class="active"':''}}><a href="{{url('/department')}}"><?php echo _('Department'); ?></a></li>
        @endif

        @if($current_user->hasAccess('setting.index') && !$current_user->isSuperUser())
        <li {{in_array(Route::currentRouteName(), array('setting.index', 'setting.edit'))?'class="active"':''}}><a href="{{route('setting.index')}}"><?php echo _('Settings'); ?></a></li>
        @endif
        
        
        @if( $current_user->hasAnyAccess(array('product.index', 'product.create', 'category.index', 'category.create')) && !$current_user->isSuperUser())
        <li class="dropdown {{in_array(Route::currentRouteName(), array('product.create', ''))?'active':''}}">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo _('Products'); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if($current_user->hasAccess('product.create') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('product.create'))?'class="active"':''}}><a href="{{route('product.create')}}"><?php echo _('New Products'); ?></a></li>
                @endif
                @if($current_user->hasAccess('product.index') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('product.index', 'product.edit'))?'class="active"':''}}><a href="{{route('product.index')}}"><?php echo _('Products'); ?></a></li>
                @endif
                @if($current_user->hasAccess('product.trash') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('product.trash'))?'class="active"':''}}><a href="{{route('product.trash')}}"><?php echo _('Trash'); ?></a></li>
                @endif

                @if( $current_user->hasAnyAccess(array('category.index', 'category.create')) && !$current_user->isSuperUser())
                <li class="divider"></li>
                <li role="presentation" class="dropdown-header">Category</li>
                @if($current_user->hasAccess('category.create') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('category.create'))?'class="active"':''}}><a href="{{route('category.create')}}"><?php echo _('New Category');?></a></li>
                @endif
                <li {{in_array(Route::currentRouteName(), array('category.index'))?'class="active"':''}}><a href="{{route('category.index')}}"><?php echo _('List Category') ?></a></li>
                @endif
            </ul>
        </li>
        @endif
        
        @if( $current_user->hasAnyAccess(array('stock.index', 'stock.create'))  && !$current_user->isSuperUser())
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Stock <b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if($current_user->hasAccess('stock.create'))
                <li {{in_array(Route::currentRouteName(), array('stock.create'))?'class="active"':''}}><a href="{{route('stock.create')}}"><?php echo _('New Stock');?></a></li>
                @endif
                @if($current_user->hasAccess('stock.index'))
                <li {{in_array(Route::currentRouteName(), array('stock.index'))?'class="active"':''}}><a href="{{route('stock.index')}}"><?php echo _('List Stock') ?></a></li>
                @endif
                <li class="divider"></li>
                @if($current_user->hasAccess('damage.index'))
                <li {{in_array(Route::currentRouteName(), array('damage.index'))?'class="active"':''}}><a href="{{route('damage.index')}}"><?php echo _('Damage List');?></a></li>
                @endif
                @if($current_user->hasAccess('damage.create'))
                <li {{in_array(Route::currentRouteName(), array('damage.create'))?'class="active"':''}}><a href="{{route('damage.create')}}"><?php echo _('Damage Reports');?></a></li>
                @endif
                @if($current_user->hasAccess('damage.trash'))
                <li {{in_array(Route::currentRouteName(), array('damage.trash'))?'class="active"':''}}><a href="{{route('damage.trash')}}"><?php echo _('Damage Trash');?></a></li>
                @endif
                @if($current_user->hasAccess('damage.manage'))
                <li {{in_array(Route::currentRouteName(), array('damage.manage'))?'class="active"':''}}><a href="{{route('damage.manage')}}"><?php echo _('Manage Damage'); ?></a></li>
                @endif

            </ul>
        </li>
        @endif

        @if( $current_user->hasAnyAccess(array('message.index', 'message.create')) && !$current_user->isSuperUser())
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php  echo _('Message'); ?> <span class="menu-super">{{get_unread_message_count()}}</span> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if($current_user->hasAccess('message.index') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('message.index'))?'class="active"':''}}><a href="{{route('message.index')}}"><?php echo _('Inbox');?></a></li>
                @endif
                @if($current_user->hasAccess('message.outbox') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('message.outbox'))?'class="active"':''}}><a href="{{route('message.outbox')}}"><?php echo _('Outbox');?></a></li>
                @endif
                @if($current_user->hasAccess('message.create') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('message.create'))?'class="active"':''}}><a href="{{route('message.create')}}"><?php echo _('Compose');?></a></li>
                @endif
                
            </ul>
        </li>
        @endif
        
        @if( $current_user->hasAnyAccess(array('report.product', 'report.user', 'report.overview')))
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php  echo _('Report'); ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if($current_user->hasAccess('report.product') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('report.product'))?'class="active"':''}}><a href="{{route('report.product')}}"><?php echo _('Product');?></a></li>
                @endif
                @if($current_user->hasAccess('report.user') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('report.user'))?'class="active"':''}}><a href="{{route('report.user')}}"><?php echo _('User');?></a></li>
                @endif
                @if($current_user->hasAccess('report.overview') && !$current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('report.overview'))?'class="active"':''}}><a href="{{route('report.overview')}}"><?php echo _('Overview');?></a></li>
                @endif
                 @if($current_user->hasAccess('report.super') && $current_user->isSuperUser())
                <li {{in_array(Route::currentRouteName(), array('report.super'))?'class="active"':''}}><a href="{{route('report.super')}}"><?php echo _('Store List');?></a></li>
                @endif
            </ul>
        </li>
        @endif
        
        @if( $current_user->hasAnyAccess(array('group.index', 'resource.index')) )
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php  echo _('Permission'); ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
                @if($current_user->hasAccess('group.index'))
                <li {{in_array(Route::currentRouteName(), array('group.index', 'group.edit'))?'class="active"':''}}><a href="{{route('group.index')}}"><?php echo _('Groups'); ?></a></li>
                @endif
                
                @if($current_user->hasAccess('resource.index'))
                <li {{in_array(Route::currentRouteName(), array('resource.index', 'resource.edit'))?'class="active"':''}}><a href="{{route('resource.index')}}"><?php  echo _('Resource'); ?></a></li>
                @endif

            </ul>
        </li>
        @endif

        @if( $current_user->hasAnyAccess(array('help.index', 'help.create')) )
        <li {{in_array(Route::currentRouteName(), array('help.index'))?'class="active"':''}}><a href="{{route('help.index')}}"><?php echo _('Help'); ?></a></li>
        @endif

        @if($current_user->hasAccess('logout'))
        <li {{in_array(Route::currentRouteName(), array('logout'))?'class="active"':''}}><a href="{{url('/logout')}}"><?php echo _('Sign Out'); ?></a></li>
        @endif

        @else
        <li {{in_array(Route::currentRouteName(), array('login'))?'class="active"':''}}><a href="{{url('/login')}}"><?php echo _('Sign In'); ?></a></li>
        <li {{in_array(Route::currentRouteName(), array('registration'))?'class="active"':''}}><a href="{{url('/registration')}}"><?php echo _('Registration'); ?></a></li>
        <li {{in_array(Route::currentRouteName(), array('help'))?'class="active"':''}}><a href="{{url('/help')}}"><?php echo _('Help'); ?></a></li>
        @endif
    </ul>
</div><!--/.nav-collapse -->