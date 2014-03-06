@extends('layout.main')
@section('content')

<div class="col-md-5">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center">EDIT RESOURCE</h5></div>
		<div class="panel-body">
			{{Form::model($resource, array('url'=>'resource/'.$resource->id, 'method'=>'put', 'class'=>'form-vertical'))}}

			<div class="form-group">
				{{Form::label('name', 'Resource Name', array('class'=>'control-label'))}}
				{{Form::text('name', Input::old('name'), array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-group">
				{{Form::label('route', 'Resource Route', array('class'=>'control-label'))}}
				{{Form::text('route', Input::old('route'), array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-primary btn-sm">Edit Resource</button>
			</div>

			{{Form::close()}}
		</div>
	</div>
</div>
@stop