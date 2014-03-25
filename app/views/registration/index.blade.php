@extends('layout.main')

@section('content')
<div class="col-md-6 col-md-offset-4">
	<h3><span class="fa fa-user"></span> Registration</h3>
	<hr>

{{ HTML::ul($errors->all()) }}
	{{Form::open(array('url'=>'/registration', 'method'=>'post', 'class'=>'form-horizontal'))}}
	<div class="form-group">
		<div class="col-md-7">
		{{Form::label('full_name', 'Full Name')}}
			{{Form::text('full_name', '', array('class'=>'form-control'))}}
		</div>
	</div>
	
	<div class="form-group ">
		<div class="col-md-7">
		{{Form::label('username', 'Username')}}
			{{Form::text('username', '', array('class'=>'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-7">
		{{Form::label('password', 'Password')}}
			{{Form::password('password', array('class'=>'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-7">
		{{Form::label('password_confirmation', 'Confirm Password')}}
			{{Form::password('password_confirmation', array('class'=>'form-control'))}}
		</div>
	</div>	
	<div class="form-group">
		<div class="col-md-7">
		{{Form::label('address', 'Address')}}
			{{Form::textarea('address', '', array('class'=>'form-control', 'rows'=>'3'))}}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-7">
		{{Form::label('email_id', 'Email Id')}}
			{{Form::text('email_id', '', array('class'=>'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-7">
		{{Form::label('phone_no', 'Phone No.')}}
			{{Form::text('phone_no', '', array('class'=>'form-control'))}}
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-7">
		{{Form::label('designation', 'Designation')}}
			{{Form::text('designation', '', array('class'=>'form-control'))}}
		</div>
	</div>


	<div class="form-group">
		<div class="col-md-7 text-right">
			<button class="btn btn-md btn-primary" type="submit" name="submit">Submit</button>
		</div>
	</div>
	{{Form::close()}}
</div>
@stop