@extends('layout.main')

@section('content')
<div class="col-md-8">

	@if(Session::has('delete'))
	<div class="alert alert-danger">
		{{Session::get('delete')}}	
	</div>
	@endif

	{{Form::open(array('url'=>route('user.index'),'method'=>'get','class'=>'form-vertical'))}}
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					{{Form::select('department', array_merge(array('0'=>'All Departments'), $departments), $filter['department'], array('class' =>'dropdown input-sm form-control'))}}
				</div>
			</div>

			<div class="col-md-4 ">
				<div class="form-group">
					{{Form::select('group', array_merge(array('0'=>'All Groups'), $groups), 'null', array('class' =>'dropdown input-sm form-control'))}}
				</div>
			</div>
			<div class="col-md-4" >
				<div class="form-group">
					<div class="input-group">
						{{Form::text('username', $filter['username'], array('class'=>'form-control','placeholder'=>'Search User'))}}
	      				<span class="input-group-btn">
	        				<button class="btn btn-default" name="search" value="Search" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
	      				</span>
		    		</div>
				</div>
			</div>
		</div>
	{{Form::close()}}

	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th class="col-md-1">#</th>
				<th class="col-md-2"><?php echo _('Username'); ?></th>
				<th class="col-md-2"><?php echo _('Department'); ?></th>
				<th class="col-md-2"><?php echo _('Store Code'); ?></th>
				<th class="col-md-3"><?php echo _('Groups'); ?></th>
				<th></th>

			</tr>
		</thead>
			<tbody>
				<?php $i=0; ?>
				@foreach($users as $user)
					<?php
					$user_groups = $user->groups()->lists('name');

					if(!empty($user_groups)) {
						$user_groups = implode(', ', $user_groups);
					}
					else
						$user_groups = '-';
					?>
					<tr>	
						<td>{{++$i}}</td>
						<td>{{$user->username}}</td>
						<td>{{!empty($user->department)?$user->department->name:'-'}}</td>
						<td>{{!empty($user->store)?$user->store->store_code:'-'}}</td>
						<td>{{$user_groups}}</td>
						<td>
							{{Form::open(array('url'=>route('user.destroy', $user->id), 'method'=>'delete'))}}
							<a href="{{route('user.edit', $user->id)}}" class="btn btn-xs btn-success tooltip-top" title="Edit User"><i class="fa fa-pencil"></i></a>
							<button type="submit" onclick="return confirm('Are you sure?');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove User" value="{{$user->id}}"><i class="fa fa-times"></i></a>
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
		<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Create User');?></h5></div>
		<div class="panel-body">

			@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}	
			</div>
			@endif

			{{Form::open(array('url'=>route('user.index'),'method'=>'post','class'=>'form-vertical'))}}
				
				<div class="form-group">
					{{Form::label('store', _('Store'), array('class'=>'control-label'))}}
					
					{{Form::select('store', $stores, Input::old('store'), array('class' =>'dropdown input-sm form-control'))}}
					
					@if($errors->has('store'))
					<p class="help-block"><span class="text-danger">{{$errors->first('store')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					{{Form::Label('group', _('Group'), array('class'=>'control-label'))}}
					{{Form::select('group', $groups, Input::old('group'), array('class' =>'dropdown input-sm form-control'))}}
					
					@if($errors->has('group'))
					<p class="help-block"><span class="text-danger">{{$errors->first('group')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					{{Form::label('dept', _('Department'),  array('class'=>'control-label'))}}
					{{Form::select('department', $departments, 'null', array('class' =>'dropdown input-sm form-control'))}}
					
					@if($errors->has('department'))
					<p class="help-block"><span class="text-danger">{{$errors->first('department')}}</span></p>
					@endif				
				</div>

				<div class="form-group">
					{{Form::label('full_name', _('Full Name'), array('class'=>'control-label'))}}
					{{Form::text('full_name', '',  array('class'=>'input-sm form-control'))}}

					@if($errors->has('full_name'))
					<p class="help-block"><span class="text-danger">{{$errors->first('full_name')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					{{Form::label('username', _('Username'), array('class'=>'control-label'))}}
					{{Form::text('username', '', array('class'=>'input-sm form-control'))}}
					
					@if($errors->has('username'))
					<p class="help-block"><span class="text-danger">{{$errors->first('username')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					{{Form::label('password', _('Password'), array('class'=>'control-label'))}}
					
					{{Form::password('password', array('class'=>'input-sm form-control'))}}
					@if($errors->has('password'))
					<p class="help-block"><span class="text-danger">{{$errors->first('password')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					{{Form::label('email_id', _('Email Id'), array('class'=>'control-label'))}}
					
					{{Form::text('email_id', '', array('class'=>'input-sm form-control'))}}
					@if($errors->has('email_id'))
					<p class="help-block"><span class="text-danger">{{$errors->first('email_id')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					{{Form::label('phone_no', _('Phone Number'), array('class'=>'control-label'))}}					
					{{Form::text('phone_no', '', array('class'=>'input-sm form-control'))}}

					@if($errors->has('phone_no'))
					<p class="help-block"><span class="text-danger">{{$errors->first('phone_no')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('address', _('Address'), array('class'=>'control-label')); ?>
					
					{{Form::textarea('address', '', array('class'=>'input-sm form-control','rows'=>'2'))}}

					@if($errors->has('address'))
					<p class="help-block"><span class="text-danger">{{$errors->first('address')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('designation', _('Designation'), array('class'=>'control-label')); ?>
					
					{{Form::text('designation', '', array('class'=>'input-sm form-control'))}}
					
					@if($errors->has('designation'))
					<p class="help-block"><span class="text-danger">{{$errors->first('designation')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('activated', _('Activated'), array('class'=>'control-label')); ?>
					
					<?php echo Form::select('activated', array(0=>_('No'), 1=>_('Yes')), 0, array('class'=>'dropdown input-sm form-control')); ?>

					@if($errors->has('activated'))
					<p class="help-block"><span class="text-danger">{{$errors->first('activated')}}</span></p>
					@endif
				</div>

				<div class="form-group text-right">
					<button type="submit" class="btn btn-sm btn-primary"><?php echo _('Submit');?></button>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
	



@stop