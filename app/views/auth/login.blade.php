@extends('layout.main')

@section('content')
<div class="login-form">
	<div class="col-md-4 col-md-offset-1">
		<h3><span class="fa fa-sign-in"></span> <?php echo _('Sign In'); ?></h3>
		<hr>

		@if(Session::has('error'))
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
		@endif

		@if(Session::has('message'))
		<div class="alert alert-success">
			{{Session::get('message')}}
		</div>
		@endif

		{{Form::open(array('url'=>'login', 'method'=>'post', 'class'=>'form form-vertical', 'autocomplete'=>'off'))}}
		<div class="form-group">
			{{Form::text('username', '', array('class'=>'form-control input-sm', 'placeholder'=>'Username'))}}

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
		<div class="form-group text-right">
			<button class="btn btn-md btn-primary">{{_('Sign In')}}</button>
		</div>
		{{Form::close()}}
	</div>

	<div class="col-md-5 col-md-offset-1">
		@include('layout.partial.quickhelp')
	</div>
</div>
@stop