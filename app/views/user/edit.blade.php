@extends('layout.main')

@section('content')
<div class="col-md-8">

	@if(Session::has('error'))
	<div class="alert alert-danger">
		{{Session::get('error')}}	
	</div>
	@endif

	@if(Session::has('delete'))
	<div class="alert alert-success">
		{{Session::get('delete')}}	
	</div>
	@endif

	@section('contentTop')
		{{Form::open(array('url'=>route('user.index'),'method'=>'get','class'=>'form-vertical', 'id'=>'user_search'))}}
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<?php echo Form::select('department', array_merge(array('0'=>_('All Departments')), $departments), $filter['department'], array('class' =>'dropdown input-sm form-control', 'id'=>'search_department'));?>
					</div>
				</div>

				<div class="col-md-4 ">
					<div class="form-group">
						<?php echo Form::select('group', array_merge(array('0'=>_('All Groups')), $groups), 'null', array('class' =>'dropdown input-sm form-control', 'id'=>'search_group'));?>
					</div>
				</div>
				<div class="col-md-4" >
					<div class="form-group">
						<div class="input-group">
							<?php echo Form::text('username', $filter['username'], array('class'=>'input-sm form-control','placeholder'=>_('Search User')));?>
		      				<span class="input-group-btn">
		        				<button class="btn btn-sm btn-default" name="search" value="<?php echo _('Search'); ?>" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
		      				</span>
			    		</div>
					</div>
				</div>
			</div>
	{{Form::close()}}
	@stop
				
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th class="col-md-2"><?php echo _('Username'); ?></th>
				<th class="col-md-3"><?php echo _('Full Name'); ?></th>
				
				@if($current_user->isSuperUser())
				<th class="col-md-3"><?php echo _('Department'); ?></th>
				@else
				<th class="col-md-3"><?php echo _('Store'); ?></th>
				@endif

				<th class="col-md-2"><?php echo _('Groups'); ?></th>
				<th class="col-md-2"></th>

			</tr>
		</thead>
			<tbody>
				<?php $i=0; ?>
				@foreach($users as $user)
					<?php
					$user_groups = $user->groups()->lists('name');

					if(!empty($user_groups)) {
						unset($user_groups[0]); // Remove Public
						$user_groups = implode(', ', $user_groups);
					}
					else
						$user_groups = '-';
					?>
					<tr {{($current_user_edited->id == $user->id)?'class="success"':''}}>
						<td>{{++$i}}</td>
						<td>{{$user->username}}</td>
						<td>{{$user->full_name}}</td>
						
						@if($current_user->isSuperUser())
						<td>{{!empty($user->store)?$user->store->department->name:'-'}}</td>
						@else
						<td>{{!empty($user->department)?$user->department->name:'-'}}</td>
						@endif

						<td>{{$user_groups}}</td>
						<td>
							{{Form::open(array('url'=>route('user.destroy', $user->id), 'method'=>'delete'))}}
								
							@if($user->id == $current_user_edited->id)
							<a href="{{route('user.edit', $user->id)}}" class="disabled btn btn-xs btn-success tooltip-top" title="<?php echo _('Edit User'); ?>"><i class="fa fa-pencil"></i></a>
							@else
							<a href="{{route('user.edit', $user->id)}}" class="btn btn-xs btn-success tooltip-top" title="<?php echo _('Edit User'); ?>"><i class="fa fa-pencil"></i></a>
							@endif
							<button type="submit" onclick="return confirm('Are you sure?');" name="id" class="btn btn-xs btn-danger tooltip-top" title="<?php echo _('Remove User'); ?>" value="{{$user->id}}"><i class="fa fa-times"></i></button>
							{{Form::close()}}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{$users->links()}}
</div>	

<div class="col-md-4">
	<div class="panel panel-default" >
		<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Edit User');?></h5></div>
		<div class="panel-body">

			@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}	
			</div>
			@endif

			{{Form::model($current_user, array('url'=>route('user.update', $current_user->id),'method'=>'put','class'=>'form-vertical'))}}
				
				<?php $current_login_user = Sentry::getUser(); ?>
				@if($current_login_user->isSuperUser())
				<div class="form-group">
					{{Form::label('store', _('Store'), array('class'=>'control-label'))}}
					
					{{Form::select('store', $stores, Input::old('store', $current_user->store_id), array('class' =>'dropdown input-sm form-control'))}}
					
					@if($errors->has('store'))
					<p class="help-block"><span class="text-danger">{{$errors->first('store')}}</span></p>
					@endif
				</div>
				@else
				{{Form::hidden('store', $current_login_user->store_id)}}
				@endif

				<div class="form-group">
					<?php
					$current_groups = $current_user->getGroups();
					$current_groups = $current_groups->lists('id');
					$public_group = Sentry::findGroupByName('Public');

					$public_group = array_search($public_group->id, $current_groups);
					unset($current_groups[$public_group]);
					$current_group = reset($current_groups);
					?>
					
					<?php echo Form::Label('group', _('Group'), array('class'=>'control-label')); ?>
					{{Form::select('group', $groups, $current_group, array('class' =>'dropdown input-sm form-control'))}}
					
					@if($errors->has('group'))
					<p class="help-block"><span class="text-danger">{{$errors->first('group')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('department', _('Department'),  array('class'=>'control-label'));?>
					{{Form::select('department', $departments, Input::old('department', $current_user->department_id), array('class' =>'dropdown input-sm form-control'))}}
					
					@if($errors->has('department'))
					<p class="help-block"><span class="text-danger">{{_($errors->first('department'))}}</span></p>
					@endif				
				</div>

				<div class="form-group">
					<?php echo Form::label('full_name', _('Full Name'), array('class'=>'control-label'));?>
					{{Form::text('full_name', Input::old('full_name'),  array('class'=>'input-sm form-control'))}}

					@if($errors->has('full_name'))
					<p class="help-block"><span class="text-danger">{{$errors->first('full_name')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('username', _('Username'), array('class'=>'control-label'));?>
					{{Form::text('username', Input::old('username'), array('class'=>'input-sm form-control'))}}
					
					@if($errors->has('username'))
					<p class="help-block"><span class="text-danger">{{$errors->first('username')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('password', _('Password'), array('class'=>'control-label')); ?>
					
					{{Form::password('password', array('class'=>'input-sm form-control'))}}

					<p class="help-block"><?php echo _('Leave blank to retain current password.');?></p>
					@if($errors->has('password'))
					<p class="help-block"><span class="text-danger">{{$errors->first('password')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('email_id', _('Email Id'), array('class'=>'control-label'));?>
					
					{{Form::text('email_id', Input::old('email_id'), array('class'=>'input-sm form-control'))}}
					@if($errors->has('email_id'))
					<p class="help-block"><span class="text-danger">{{$errors->first('email_id')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('phone_no', _('Phone Number'), array('class'=>'control-label'));?>
					{{Form::text('phone_no', Input::old('phone_no'), array('class'=>'input-sm form-control'))}}

					@if($errors->has('phone_no'))
					<p class="help-block"><span class="text-danger">{{$errors->first('phone_no')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('address', _('Address'), array('class'=>'control-label'));?>
					
					{{Form::textarea('address', Input::old('address'), array('class'=>'input-sm form-control','rows'=>'2'))}}

					@if($errors->has('address'))
					<p class="help-block"><span class="text-danger">{{$errors->first('address')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('designation', _('Designation'), array('class'=>'control-label'));?>
					
					{{Form::text('designation', Input::old('designation'), array('class'=>'input-sm form-control'))}}
					
					@if($errors->has('designation'))
					<p class="help-block"><span class="text-danger">{{$errors->first('designation')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('activated', _('Activated'), array('class'=>'control-label'));?>
					
					{{Form::select('activated', array(0=>'No', 1=>'Yes'), Input::old('activated'), array('class'=>'dropdown input-sm form-control'))}}

					@if($errors->has('activated'))
					<p class="help-block"><span class="text-danger">{{$errors->first('activated')}}</span></p>
					@endif
				</div>

				<div class="form-group text-right">
					<button type="submit" class="btn btn-sm btn-primary"><?php echo _('Save');?></button>
					<a href="{{route('user.index')}}" class="btn btn-sm btn-primary"><?php echo _('Cancel');?></a>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>

@stop

@section('scripts')
	<script type="text/javascript">
	$(function(){

	    $('#search_department').on('change', function(){
	        $('#user_search').submit();
	    });
	});
	$(function(){

	    $('#search_group').on('change', function(){
	        $('#user_search').submit();
	    });
	});
	</script>
@stop