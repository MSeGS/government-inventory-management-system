@extends('layout.main')

@section('content')
<div class="login-form">
	<div class="col-md-4 col-md-offset-1">
		<h3><span class="fa fa-user"></span> <?php echo _('Retrieve Username'); ?></h3>
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

		{{Form::open(array('url'=>'retrieve-username', 'method'=>'post', 'class'=>'form form-vertical', 'autocomplete'=>'off'))}}
		<div class="form-group">
			{{Form::text('email', '', array('class'=>'form-control input-sm', 'placeholder'=>'Email Address'))}}
			
			<p class="help-block"><?php echo _('Please provide your email address and we will send you your username.'); ?></p>

			@if($errors->has('email'))
			<p class="help-block"><span class="text-danger">{{$errors->first('email')}}</span></p>
			@endif
		</div>
		<div class="form-group text-right">
			<button class="btn btn-md btn-primary">{{_('Retrieve')}}</button>
		</div>
		{{Form::close()}}
	</div>

	<div class="col-md-5 col-md-offset-1">
		@include('layout.partial.quickhelp')
	</div>
</div>
@stop