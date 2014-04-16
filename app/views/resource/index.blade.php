@extends('layout.main')

@section('content')
<div class="col-md-8">
	@if(Session::has('delete'))
		<div class="alert alert-danger">
			{{Session::get('delete')}}	
		</div>
	@endif
	<div class="row">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-5">RESOURCE NAME</th>
					<th class="col-md-3">RESOURCE ROUTE</th>
					<th class="col-md-3"></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; ?>
				@foreach($resources as $resource)
				<tr>
					<td>{{++$i}}</td>
					<td>{{$resource->name}}</td>
					<td>{{$resource->route}}</td>
					<td>
						{{Form::open(array('url'=>'resource/'.$resource->id, 'method'=>'delete'))}}
						<a href="{{route('resource.edit', array($resource->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Resource"><i class="fa fa-pencil"></i></a>
						<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Resource" value="{{$resource->id}}"><i class="fa fa-times"></i></a>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	{{$resources->links()}}
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center">NEW RESOURCE</h5></div>
			{{Form::open(array('url'=>'resource', 'method'=>'post', 'class'=>'form-vertical'))}}
		<div class="panel-body">
			@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}	
				</div>
			@endif
			<div class="form-group">
				{{Form::label('name', 'Resource Name', array('class'=>'control-label'))}}
				{{Form::text('name', '', array('class'=>'form-control input-sm'))}}

				@if($errors->has('name'))
				<p class="help-block"><span class="text-danger">{{$errors->first('name')}}</span></p>
				@endif
			</div>

			<div class="form-group">
				{{Form::label('route', 'Resource Route', array('class'=>'control-label'))}}
				{{Form::text('route', '', array('class'=>'form-control input-sm'))}}

				@if($errors->has('route'))
				<p class="help-block"><span class="text-danger">{{$errors->first('route')}}</span></p>
				@endif
			</div>

			<div class="form-group text-right">
				<button type="submit" name="submit" class="btn btn-primary btn-sm pull-right">{{_('Submit')}}</button>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop