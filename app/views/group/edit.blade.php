@extends('layout.main')
@section('content')
	<div class="col-md-7">
	<table class="table table-condensed table-striped table-bordered">
		<thead>
			<tr>
				<th class="col-md-1">#</th>
				<th class="col-md-8">GROUP NAME</th>
				<th class="col-md-3"></th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			@foreach($groups as $group)
			<tr>
				<td>{{++$i}}</td>
				<td>{{$group->name}}</td>
				<td>
					{{Form::open(array('url'=>'group/'.$group->id, 'method'=>'delete'))}}
					<a href="{{route('group.edit', array($group->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Group Name"><i class="fa fa-pencil"></i></a>
					<a href="{{route('group.permission', array($group->id))}}" class="btn btn-xs btn-primary tooltip-top" title="Manage Group Permissions"><i class="fa fa-cog"></i></a>
					<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Group" value="{{$group->id}}"><i class="fa fa-times"></i></a>

					{{Form::close()}}	
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="col-md-5">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center">EDIT GROUP</h5></div>
		<div class="panel-body">
			{{Form::model($groupById, array('url'=>'group/'.$groupById->id, 'method'=>'put', 'class'=>'form-vertical'))}}

			<div class="form-group">
				{{Form::label('name', 'Group Name', array('class'=>'control-label'))}}
				{{Form::text('name', Input::old('name'), array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-group">
				<button type="submit" name="submit" class="btn btn-primary btn-sm">Edit Group</button>
			</div>

			{{Form::close()}}
		</div>
	</div>
</div>
@stop