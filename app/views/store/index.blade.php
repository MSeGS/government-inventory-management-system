@extends('layout.main')

@section('content')
<div class="col-md-7">
	<table class="table table-condensed table-striped table-bordered">
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
		</tbody>
	</table>

	{{$stores->links()}}
</div>
<div class="col-md-5">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center">NEW STORE</h5></div>
		<div class="panel-body">
			{{Form::open(array('url'=>'store', 'method'=>'post', 'class'=>'form-vertical'))}}

			<div class="form-group">
				{{Form::label('department_id', 'Department', array('class'=>'control-label'))}}
				{{Form::select('department_id', $departments, '', array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-group">
				{{Form::label('route', 'Resource Route', array('class'=>'control-label'))}}
				{{Form::text('route', '', array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-primary btn-sm">Add Resource</button>
			</div>

			{{Form::close()}}
		</div>
	</div>
</div>
@stop