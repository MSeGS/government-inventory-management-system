@extends('layout.main')

@section('content')
<div class="col-md-6 col-md-offset-3">
	<h3><span class="fa fa-user"></span> Registration</h3>
	<hr>

{{ HTML::ul($errors->all()) }}
	{{Form::open(array('url'=>'/registration', 'method'=>'post', 'class'=>'form-horizontal'))}}
	<div class="form-group">
		{{Form::label('full_name', 'Full Name', array('class'=>'col-md-4 control-label'))}}
		<div class="col-md-8">
			{{Form::text('full_name', '', array('class'=>'form-control'))}}
		</div>
	</div>
	
	<div class="form-group">
		{{Form::label('username', 'Username', array('class'=>'col-md-4 control-label'))}}
		<div class="col-md-8">
			{{Form::text('username', '', array('class'=>'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('password', 'Password', array('class'=>'col-md-4 control-label'))}}
		<div class="col-md-8">
			{{Form::password('password', array('class'=>'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('password_confirmation', 'Confirm Password', array('class'=>'col-md-4 control-label'))}}
		<div class="col-md-8">
			{{Form::password('password_confirmation', array('class'=>'form-control'))}}
		</div>
	</div>	
	<div class="form-group">
		{{Form::label('address', 'Address', array('class'=>'col-md-4 control-label'))}}
		<div class="col-md-8">
			{{Form::textarea('address', '', array('class'=>'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('email_id', 'Email Id', array('class'=>'col-md-4 control-label'))}}
		<div class="col-md-8">
			{{Form::text('email_id', '', array('class'=>'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('phone_no', 'Phone No.', array('class'=>'col-md-4 control-label'))}}
		<div class="col-md-8">
			{{Form::text('phone_no', '', array('class'=>'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		{{Form::label('designation', 'Designation', array('class'=>'col-md-4 control-label'))}}
		<div class="col-md-8">
			{{Form::text('designation', '', array('class'=>'form-control'))}}
		</div>
	</div>


	<div class="form-group">
		<div class="col-md-12 text-right">
			<button class="btn btn-md btn-primary" type="submit" name="submit">Submit</button>
		</div>
	</div>
	{{Form::close()}}
</div>
@stop