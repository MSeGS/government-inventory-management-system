@extends('layout.main')

@section('content')
<div class="login-form">
	<div class="col-md-4 col-md-offset-4">
		<h3><span class="fa fa-key"></span> <?php echo _('Set New Password'); ?></h3>
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


		@if($validCode)

		{{Form::open(array('url'=>'new-password', 'method'=>'post', 'class'=>'form form-vertical', 'autocomplete'=>'off'))}}
		<div class="form-group">
			{{Form::password('password', array('class'=>'form-control input-sm', 'placeholder'=>'New Password'))}}
			
			@if($errors->has('password'))
			<p class="help-block"><span class="text-danger">{{$errors->first('password')}}</span></p>
			@endif
		</div>
		<div class="form-group">
			{{Form::password('password_confirm', array('class'=>'form-control input-sm', 'placeholder'=>'Confirm New Password'))}}
			
			@if($errors->has('password_confirm'))
			<p class="help-block"><span class="text-danger">{{$errors->first('password_confirm')}}</span></p>
			@endif
		</div>
		{{Form::hidden('code', $code)}}
		<div class="form-group text-right">
			<button class="btn btn-md btn-primary">{{_('Submit')}}</button>
		</div>
		{{Form::close()}}
		
		@else
		<div class="alert alert-info"><?php echo _('Invalid reset password code. Please try again or contact us.'); ?></div>
		@endif
	</div>
</div>
@stop