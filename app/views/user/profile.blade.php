@extends('layout.main')

@section('content')
<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default" >
		<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Update Profile');?></h5></div>
		<div class="panel-body">

			@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}	
			</div>
			@endif

			{{Form::open(array('url'=>route('user.profileUpdate'),'method'=>'put','class'=>'form-vertical'))}}
				
				<div class="form-group">
					<?php echo Form::label('group', _('Group'), array('class'=>'control-label'));?>
					@foreach( $groups as $group )
						@if( $group->id != 1 )
							<p class="form-control-static">{{ $group->name }}</p>
						@endif
					@endforeach
				</div>

				<div class="form-group">
					<?php echo Form::label('department', _('Department'), array('class'=>'control-label'));?>
					<p class="form-control-static">{{$department_name->name}}</p>
				</div>

				<div class="form-group">
					<?php echo Form::label('full_name', _('Full Name'), array('class'=>'control-label'));?>
					{{Form::text('full_name', Input::old('full_name', $user->full_name),  array('class'=>'input-sm form-control'))}}

					@if($errors->has('full_name'))
					<p class="help-block"><span class="text-danger">{{$errors->first('full_name')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('username', _('Username'), array('class'=>'control-label'));?>
					{{Form::text('username', Input::old('username', $user->username), array('class'=>'input-sm form-control'))}}
					
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
					
					{{Form::text('email_id', Input::old('email_id', $user->email_id), array('class'=>'input-sm form-control'))}}
					@if($errors->has('email_id'))
					<p class="help-block"><span class="text-danger">{{$errors->first('email_id')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('phone_no', _('Phone Number'), array('class'=>'control-label'));?>
					{{Form::text('phone_no', Input::old('phone_no', $user->phone_no), array('class'=>'input-sm form-control'))}}

					@if($errors->has('phone_no'))
					<p class="help-block"><span class="text-danger">{{$errors->first('phone_no')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('address', _('Address'), array('class'=>'control-label'));?>
					
					{{Form::textarea('address', Input::old('address', $user->address), array('class'=>'input-sm form-control','rows'=>'2'))}}

					@if($errors->has('address'))
					<p class="help-block"><span class="text-danger">{{$errors->first('address')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('designation', _('Designation'), array('class'=>'control-label'));?>
					
					{{Form::text('designation', Input::old('designation', $user->designation), array('class'=>'input-sm form-control'))}}
					
					@if($errors->has('designation'))
					<p class="help-block"><span class="text-danger">{{$errors->first('designation')}}</span></p>
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