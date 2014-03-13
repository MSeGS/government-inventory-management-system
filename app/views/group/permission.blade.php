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
		{{Form::open(array('url'=>'group/'.$group->id.'/permission', 'method'=>'put'))}}
		<div class="panel-heading"><h5 class="text-center">{{strtoupper($current_group->getName())}} GROUP PERMISSION</h5></div>
		<div class="panel-body group-permissions-list">
	
			<?php $permissions = $current_group->getPermissions(); ?>
			<table class="table table-condensed table-striped">
				<thead>
					<tr>
						<th class="col-md-1">#</th>
						<th class="col-md-5">Resource Name</th>
						<th class="col-md-3">Allowed</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0 ?>
					@foreach($resources as $resource)
					<tr>
						<td>{{++$i}}</td>
						<td>{{$resource->name}}</td>
						<td class="form-inline">
							<div class="checkbox col-md-12">
							  <label style="display:block;">
							    <input type="checkbox" name="{{$resource->route}}" 
							    	@if(array_key_exists($resource->route, $permissions) && $permissions[$resource->route] == 1)
							    	checked="checked"
							    	@endif
							    	value="1" />
							  </label>
							</div>
							<!-- <div class="checkbox">
							  <label>
							    <input type="checkbox" value="0">
							    Deny
							  </label>
							</div> -->
		<?php 
		// if(array_key_exists($resource->route, $permissions)() && $permissions[$resource->route] == 1)
			// make 1 active
		// else if(array_key_exists($resource->route, $permissions)() && $permissions[$resource->route] == 0)
			// make 0 active
		// else
			// do nothing
		  ?>
						</td>
					</tr>
					
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="panel-footer">
			<button type="submit" class="form-control">Submit</button>
		</div>
		{{Form::close()}}
	</div>
</div>
@stop