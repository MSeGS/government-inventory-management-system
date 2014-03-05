@extends('layout.main')

@section('content')
<div class="col-md-6 col-md-offset-3">
	<h3><span class="fa fa-user"></span> Registration</h3>
	<hr>

	{{Form::open(array('url'=>'', 'method'=>'post', 'class'=>'form-horizontal'))}}
	<div class="form-group">
		{{Form::label('username', 'Username', array('class'=>'col-md-4 control-label'))}}
		<div class="col-md-8">
			{{Form::text('username', '', array('class'=>'form-control'))}}
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