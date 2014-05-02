@extends('layout.main')

@section('content')
<div class="col-md-5 col-md-offset-4">
	<h3><span class="fa fa-user"></span> Contact Us</h3>
	<hr>
	{{Form::open(array('url'=>route('contact.store'), 'method'=>'post', 'class'=>'form-vertical'))}}
	<div class="form-group">
		{{Form::text('name', Input::old('Name'), array('class'=>'form-control input-sm', 'placeholder'=>'Name'))}}
		
		@if($errors->has('name'))
		<p class="help-block"><span class="text-danger">{{$errors->first('name')}}</span></p>
		@endif
	</div>
	
	<div class="form-group">
		{{Form::text('department', Input::old('department'), array('class'=>'form-control input-sm', 'placeholder'=>'Department'))}}

		@if($errors->has('department'))
		<p class="help-block"><span class="text-danger">{{$errors->first('department')}}</span></p>
		@endif
	</div>
	
	<div class="form-group ">
		{{Form::text('email', Input::old('email'), array('class'=>'form-control input-sm', 'placeholder'=>'Email'))}}

		@if($errors->has('email'))
		<p class="help-block"><span class="text-danger">{{$errors->first('email')}}</span></p>
		@endif
	</div>

	<div class="form-group">
		{{Form::text('phone_no', Input::old('phone_no'), array('class'=>'form-control input-sm', 'placeholder'=>'Phone Number'))}}

		@if($errors->has('phone_no'))
		<p class="help-block"><span class="text-danger">{{$errors->first('phone_no')}}</span></p>
		@endif
	</div>
	<div class="form-group">
		{{Form::textarea('note', Input::old('note'), array('class'=>'form-control input-sm', 'placeholder'=>'Your Query here', 'rows'=>'5'))}}

		@if($errors->has('note'))
		<p class="help-block"><span class="text-danger">{{$errors->first('note')}}</span></p>
		@endif
	</div>


	<div class="form-group text-right">
		<button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
	</div>
	
	{{Form::close()}}
</div>

@stop