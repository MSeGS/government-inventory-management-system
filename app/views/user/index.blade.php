@extends('layout.main')

@section('content')
<div class="col-md-8">
	{{Form::open(array('url'=>'user','method'=>'get','class'=>'form-vertical'))}}
		<div class="col-md-4">
			<div class="form-group">
				{{Form::select('department', $departments, $filter['department'], array('class' =>'input-sm form-control'))}}
			</div>
		</div>

		<div class="col-md-4 ">
			<div class="form-group">
				{{Form::select('group', $groups, 'null', array('class' =>'input-sm form-control'))}}
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
		{{Form::close()}}
				
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th class="col-md-1">#</th>
				<th class="col-md-3">USERNAME</th>
				<th class="col-md-3">DEPARTMENT</th>
				<th class="col-md-2">STORE ID</th>
				<th class="col-md-3">ROLE</th>
				<!-- <th class="col-md-1"></th> -->

			</tr>
		</thead>
			<tbody>
				<?php $i=0; ?>
				@foreach($users as $user)
					<tr>	
						<td>{{++$i}}</td>
						<td>{{$user->username}}</td>
						<td>{{Department::find($user->department_id)['name']}}</td>
						<td>{{$user->store_id}}</td>
						<td>{{ucwords(str_replace("_","",$user->getgroup_id))}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{$users->links()}}
</div>	

<div class="col-md-4">
	<div class="panel panel-default" >
		<div class="panel-heading" ><h5 class="text-center"> CREATE USER </h5></div>
			<div class="panel-body">
				{{Form::open(array('url'=>'user','method'=>'post','class'=>'form-vertical'))}}
					
				<div class="form-group">
				{{Form::Label('group_id', 'Role', array('class'=>'control-label'))}}
						{{Form::select('group_id', $groups, 'null', array('class' =>'input-sm form-control'))}}
						@if($errors->has('group_id'))
						<p class="help-block"><span class="text-danger">{{"The Role field is required"}}</span></p>
						@endif
				</div>
				<div class="form-group">
					{{Form::label('dept', 'Department',  array('class'=>'control-label'))}}
					
						{{Form::select('department', $departments, 'null', array('class' =>'input-sm form-control'))}}
						@if($errors->has('department'))
						<p class="help-block"><span class="text-danger">{{$errors->first('department')}}</span></p>
						@endif
				
				</div>
				<div class="form-group">
					{{Form::label('full_name', 'Full Name', array('class'=>'control-label'))}}
					
						{{Form::text('full_name', '',  array('class'=>'input-sm form-control', 'placeholder'=>'Full Name'))}}
						@if($errors->has('full_name'))
						<p class="help-block"><span class="text-danger">{{$errors->first('full_name')}}</span></p>
						@endif
					
				</div>
				<div class="form-group">
					{{Form::label('username', 'Username', array('class'=>'control-label'))}}
					
						{{Form::text('username', '', array('class'=>'input-sm form-control', 'placeholder'=>'Username' ))}}
						@if($errors->has('username'))
						<p class="help-block"><span class="text-danger">{{$errors->first('username')}}</span></p>
						@endif
					
				</div>
				<div class="form-group">
					{{Form::label('password', 'Password', array('class'=>'control-label'))}}
					
						{{Form::password('password', array('class'=>'input-sm form-control', 'placeholder'=>'Password'))}}
						@if($errors->has('password'))
						<p class="help-block"><span class="text-danger">{{$errors->first('password')}}</span></p>
						@endif
					
				</div>
				<div class="form-group">
					{{Form::label('email_id', 'Email Id', array('class'=>'control-label'))}}
					
						{{Form::text('email_id', '', array('class'=>'input-sm form-control', 'placeholder'=>'Email address'))}}
						@if($errors->has('email_id'))
						<p class="help-block"><span class="text-danger">{{$errors->first('email_id')}}</span></p>
						@endif
					
				</div>
				<div class="form-group">
					{{Form::label('phone_no', 'Phone No.', array('class'=>'control-label'))}}
					
						{{Form::text('phone_no', '', array('class'=>'input-sm form-control', 'placeholder'=>'Phone Number'))}}
					
				</div>
				<div class="form-group">
					{{Form::label('address', 'Address', array('class'=>'control-label'))}}
					
						{{Form::textarea('address', '', array('class'=>'input-sm form-control','style'=>'height:100px', 'placeholder'=>'Address'))}}
					
				</div>
				<div class="form-group">
					{{Form::label('store_id', 'Store Id', array('class'=>'control-label'))}}
					
						{{Form::select('store_id', $stores, 'null', array('class' =>'input-sm form-control'))}}
						@if($errors->has('store_id'))
						<p class="help-block"><span class="text-danger">{{$errors->first('store_id')}}</span></p>
						@endif
					
				</div>
				<div class="form-group">
					{{Form::label('designation', 'Designation', array('class'=>'control-label'))}}
					
						{{Form::text('designation', '', array('class'=>'input-sm form-control','placeholder'=>'Designation'))}}
						@if($errors->has('designation'))
						<p class="help-block"><span class="text-danger">{{$errors->first('designation')}}</span></p>
						@endif
					
				</div>
				<div class="form-group">
					<div class="col-md-8"></div>
						<button type="submit" class="btn btn-primary">Create User</button>
						{{ Form::token() }}
				</div>
			</div>
	</div>
		{{Form::close()}}
</div>
	



@stop