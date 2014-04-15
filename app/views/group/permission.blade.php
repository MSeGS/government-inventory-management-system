@extends('layout.main')
@section('content')
<div class="col-md-7">

	@if(Session::has('delete'))
	<div class="alert alert-success">
		{{Session::get('delete')}}	
	</div>
	@endif

	<table class="table table-striped table-bordered">
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
			<tr {{($current_group->id == $group->id)?'class="success"':''}}>
				<td>{{++$i}}</td>
				<td>{{$group->name}}</td>
				<td>
					{{Form::open(array('url'=>'group/'.$group->id, 'method'=>'delete'))}}
					<a href="{{route('group.edit', array($group->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Group Name"><i class="fa fa-pencil"></i></a>
					@if($current_group->id== $group->id)
					<a href="{{route('group.permission', array($group->id))}}" class="btn btn-xs btn-primary tooltip-top disabled" title="Manage Group Permissions"><i class="fa fa-cog"></i></a>
					@else
					<a href="{{route('group.permission', array($group->id))}}" class="btn btn-xs btn-primary tooltip-top" title="Manage Group Permissions"><i class="fa fa-cog"></i></a>
					@endif
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
			<div class="panel-heading">
				<h5 class="text-center">{{strtoupper($current_group->getName())}} GROUP PERMISSION</h5>
			</div>
			<div class="panel-body">

				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}	
				</div>
				@endif

			{{Form::open(array('url'=>'group/'.$current_group->id.'/permission', 'method'=>'put'))}}
				<div class="group-permissions-list">
					<?php
					$permissions = $current_group->getPermissions();
					?>
					
					<table class="table table table-striped">
						<thead>
							<tr>
								<th class="col-md-1">#</th>
								<th class="col-md-5">Resource Name</th>
								<th class="col-md-3">
									Allowed
									<input type="checkbox" id="checkAll" onclick="checkAll(this)">
								</th>
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
									    <input type="checkbox" name="permission[{{$resource->route}}]" 
									    	@if(array_key_exists($resource->route, $permissions) && $permissions[$resource->route] == 1)
									    	checked="checked"
									    	@endif
									    	value="1", id="checkitem" />
									  </label>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="form-inline text-right">
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-sm pull-right">Save</button>
					</div>
					<div class="form-group">
						<button type="reset" class="btn btn-primary btn-sm pull-right">Reset</button>
					</div>
					<div class="form-group">
						<a href="{{route('group.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
					</div>
				</div>
			</div>
		{{Form::close()}}
	</div>
</div>
@stop