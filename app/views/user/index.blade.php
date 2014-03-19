@extends('layout.main')

@section('content')
<div class="rows">
		<div class="col-md-4 pull-right">
			<div class="panel panel-default" >
				<div class="user-form">
					<div class="panel-heading" style="background-color:#BBB"><h4><i class="glyphicon glyphicon-user"></i> User Create</h4></div>
					<hr>
					{{ HTML::ul($errors->all()) }}
					{{Form::open(array('class'=>'form-horizontal'))}}
						
							<div class="form-group">
							{{Form::Label('group_id', 'Role', array('class'=>'col-md-4 control-label'))}}
							<div class="col-md-6">
									{{Form::select('group_id', $groups, 'null', array('class' =>'input-sm form-control'))}}
								</div>
							</div>
							<div class="form-group">
								{{Form::label('dept', 'Department',  array('class'=>'col-md-4 control-label'))}}
								<div class="col-md-6">
									{{Form::select('department', $departments, 'null', array('class' =>'input-sm form-control'))}}
								</div>
							</div>
							<div class="form-group">
								{{Form::label('full_name', 'Full Name', array('class'=>'col-md-4 control-label'))}}
								<div class="col-md-6" >
									{{Form::text('full_name', '',  array('class'=>'input-sm form-control', 'placeholder'=>'Full Name'))}}
								</div>
							</div>
							<div class="form-group">
								{{Form::label('username', 'Username', array('class'=>'col-md-4 control-label'))}}
								<div class="col-md-6">
									{{Form::text('username', '', array('class'=>'input-sm form-control', 'placeholder'=>'Username' ))}}
								</div>
							</div>
							<div class="form-group">
								{{Form::label('password', 'Password', array('class'=>'col-md-4 control-label'))}}
								<div class="col-md-6">
									{{Form::password('password', array('class'=>'input-sm form-control', 'placeholder'=>'Password'))}}
								</div>
							</div>
							<div class="form-group">
								{{Form::label('email_id', 'Email Id', array('class'=>'col-md-4 control-label'))}}
								<div class="col-md-6">
									{{Form::text('email_id', '', array('class'=>'input-sm form-control', 'placeholder'=>'Email address'))}}
								</div>
							</div>
							<div class="form-group">
								{{Form::label('phone_no', 'Phone No.', array('class'=>'col-md-4 control-label'))}}
								<div class="col-md-6">
									{{Form::text('phone_no', '', array('class'=>'input-sm form-control', 'placeholder'=>'Phone Number'))}}
								</div>
							</div>
							<div class="form-group">
								{{Form::label('address', 'Address', array('class'=>'col-md-4 control-label'))}}
								<div class="col-md-6">
									{{Form::textarea('address', '', array('class'=>'input-sm form-control', 'placeholder'=>'Address'))}}
								</div>
							</div>
							<div class="form-group">
								{{Form::label('store_id', 'Store Id', array('class'=>'col-md-4 control-label'))}}
								<div class="col-md-6">
									{{Form::select('store_id', $stores, 'null', array('class' =>'input-sm form-control'))}}
								</div>
							</div>
							<div class="form-group">
								{{Form::label('designation', 'Designation', array('class'=>'col-md-4 control-label'))}}
								<div class="col-md-6">
									{{Form::text('designation', '', array('class'=>'input-sm form-control','placeholder'=>'Designation'))}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-4 col-md-2">
									<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-user"> Create User</span></button>
									{{ Form::token() }}
								</div>
							</div>
					{{Form::close()}}
			</div>
		</div>
	</div>

	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading" style="background-color:#BBB"><h4><i class="glyphicon glyphicon-list"></i> User</h4></div>
					<hr>
					<form class="form-toobar form form-inline" method="get" action>
					<div class="form-group">
							{{Form::select('Role', 
							array(
								'all Department'	=> 'All Roles',
								'Super Administrator'	=> 'Super Administrator',
								'Administrator'		=>	'Administrator',
								'Indentor'			=> 	'Indentor'

							))}}
							
					</div>
				</form>
		</div>	
	</div>

</div>



@stop