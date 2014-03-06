@extends('layout.main')

@section('content')
<div class="col-md-7">
	{{Form::open(array('url'=>'group'))}}
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
					<a href="{{route('group.edit', array($group->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Group Name"><i class="fa fa-pencil"></i></a>
					<a href="#" class="btn btn-xs btn-primary tooltip-top" title="Manage Group Permissions"><i class="fa fa-cog"></i></a>
					<a href="#" class="btn btn-xs btn-danger tooltip-top" title="Remove Group"><i class="fa fa-times"></i></a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="col-md-5">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center">NEW GROUP</h5></div>
		<div class="panel-body">
			{{Form::open(array('url'=>'group', 'method'=>'post', 'class'=>'form-vertical'))}}

			<div class="form-group">
				{{Form::label('name', 'Group Name', array('class'=>'control-label'))}}
				{{Form::text('name', '', array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-group">
				<button type="button" name="submit" class="btn btn-primary btn-sm">Add Group</button>
			</div>

			{{Form::close()}}
		</div>
	</div>
</div>
@stop