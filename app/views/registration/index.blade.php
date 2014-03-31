@extends('layout.main')

@section('content')
<div class="col-md-4 col-md-offset-1">
	<h3><span class="fa fa-user"></span> User Registration</h3>
	<hr>
	{{Form::open(array('url'=>'/registration', 'method'=>'post', 'class'=>'form-vertical'))}}
	<div class="form-group">
		{{Form::text('full_name', Input::old(''), array('class'=>'form-control input-sm', 'placeholder'=>'Full Name'))}}
		
		@if($errors->has('full_name'))
		<p class="help-block"><span class="text-danger">{{$errors->first('full_name')}}</span></p>
		@endif
	</div>
	
	<div class="form-group ">
		{{Form::text('username', Input::old('username'), array('class'=>'form-control input-sm', 'placeholder'=>'Username'))}}

		@if($errors->has('username'))
		<p class="help-block"><span class="text-danger">{{$errors->first('username')}}</span></p>
		@endif
	</div>

	<div class="form-group">
		{{Form::password('password', array('class'=>'form-control input-sm', 'placeholder'=>'Password'))}}

		@if($errors->has('password'))
		<p class="help-block"><span class="text-danger">{{$errors->first('password')}}</span></p>
		@endif
	</div>

	<div class="form-group">
		{{Form::password('password_confirmation', array('class'=>'form-control input-sm', 'placeholder'=>'Confirm Password'))}}

		@if($errors->has('password_confirmation'))
		<p class="help-block"><span class="text-danger">{{$errors->first('password_confirmation')}}</span></p>
		@endif
	</div>	

	<div class="form-group">
		{{Form::textarea('address', Input::old('address'), array('class'=>'form-control input-sm', 'placeholder'=>'Address', 'rows'=>'3'))}}

		@if($errors->has('address'))
		<p class="help-block"><span class="text-danger">{{$errors->first('address')}}</span></p>
		@endif
	</div>

	<div class="form-group">
		{{Form::text('email_id', Input::old('email_id'), array('class'=>'form-control input-sm', 'placeholder'=>'Email Address'))}}

		@if($errors->has('email_id'))
		<p class="help-block"><span class="text-danger">{{$errors->first('email_id')}}</span></p>
		@endif
	</div>

	<div class="form-group">
		{{Form::text('phone_no', Input::old('phone_no'), array('class'=>'form-control input-sm', 'placeholder'=>'Phone Number'))}}

		@if($errors->has('phone_no'))
		<p class="help-block"><span class="text-danger">{{$errors->first('phone_no')}}</span></p>
		@endif
	</div>

	<div class="form-group">
		{{Form::text('designation', Input::old('designation'), array('class'=>'form-control input-sm', 'placeholder'=>'Designation'))}}

		@if($errors->has('designation'))
		<p class="help-block"><span class="text-danger">{{$errors->first('designation')}}</span></p>
		@endif
	</div>

	<div class="form-group text-right">
		<button class="btn btn-md btn-primary" type="submit" name="submit">Submit</button>
	</div>
	
	{{Form::close()}}
</div>

<div class="col-md-5 col-md-offset-1">
	<h3><span class="fa fa-info-circle"></span> {{_('Quick Help')}}</h3>
	<hr>
	<ol>
		<li><a href="{{url('/reset-password')}}">{{_('Forgot password? Click here.')}}</a></li>
		<li><a href="{{url('/retrieve-username')}}">{{_('Forgot username? Get it back here.')}}</a></li>
		<li>{{_('If you have any problem signing in')}}, <a href="{{url('/contact-us')}}">{{_('contact us')}}</a></li>
	</ol>
</div>
@stop