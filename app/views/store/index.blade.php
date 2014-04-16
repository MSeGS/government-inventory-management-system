@extends('layout.main')

@section('content')

<div class="col-md-8">
	<div class="row">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-5">DEPARTMENT</th>
					<th class="col-md-3">STORE CODE</th>
					<th class="col-md-3"></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; ?>

				@if($stores->count())

				@foreach($stores as $store)
				<tr>
					<td>{{++$i}}</td>
					<td>{{$store->department->name}}</td>
					<td><strong>{{$store->store_code}}</strong></td>
					<td>
						{{Form::open(array('url'=>'store/'.$store->id, 'method'=>'delete'))}}
						<a href="{{route('store.edit', array($store->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Store"><i class="fa fa-pencil"></i></a>
						<button type="submit" onclick="return confirm('Are you sure?');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Store" value="{{$store->id}}"><i class="fa fa-times"></i></a>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
				@else
				<tr><td colspan="4" class="text-center text-danger"><em>{{_("Right now, we don't have store to display. Create store on the right side.")}}</em></td></tr>
				@endif
			</tbody>
		</table>
	</div>
	{{$stores->links()}}
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center">New Store</h5></div>
		<div class="panel-body">

			@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}	
			</div>
			@endif
		
			{{Form::open(array('url'=>'store', 'method'=>'post', 'class'=>'form-vertical'))}}

			<div class="form-group">
				{{Form::label('department_id', 'Department', array('class'=>'control-label'))}}
				{{Form::select('department_id', $departments, Input::old('department_id'), array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-group">
				{{Form::label('store_code', 'Store Code', array('class'=>'control-label'))}}
				{{Form::text('store_code', Input::old('store_code'), array('class'=>'form-control input-sm'))}}

				@if($errors->has('store_code'))
				<p class="help-block"><span class="text-danger">{{$errors->first('store_code')}}</span></p>
				@endif
			</div>

			<div class="form-group text-right">
				<button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
			</div>

			{{Form::close()}}

		</div>
	</div>
</div>
@stop