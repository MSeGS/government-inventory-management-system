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
					<th class="col-md-8"><?php echo _('Group Name');?></th>
					<th class="col-md-3"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($groups as $key=>$group)
				<tr {{($current_group->id == $group->id)?'class="success"':''}}>
					<td>{{$key + $index}}</td>
					<td>{{$group->name}}</td>
					<td>
						{{Form::open(array('url'=>route('group.destroy', $group->id), 'method'=>'delete'))}}
						@if($current_group->id == $group->id)
						<a href="{{route('group.edit', array($group->id, 'page='.$groups->getCurrentPage()))}}" class="btn btn-xs btn-success tooltip-top disabled" title="<?php echo _('Edit Group Name');?>"><i class="fa fa-pencil"></i></a>
						@else
						<a href="{{route('group.edit', array($group->id))}}" class="btn btn-xs btn-success tooltip-top" title="<?php echo _('Edit Group Name');?>"><i class="fa fa-pencil"></i></a>
						@endif
						<a href="{{route('group.permission', array($group->id))}}" class="btn btn-xs btn-primary tooltip-top" title="<?php echo _('Manage Group Permissions'); ?>"><i class="fa fa-cog"></i></a>
						<button type="submit" onclick="return confirm('<?php echo _('Are you sure'); ?>');" name="id" class="btn btn-xs btn-danger tooltip-top" title="<?php echo _('Remove Group'); ?>" value="{{$group->id}}"><i class="fa fa-times"></i></button>

						{{Form::close()}}	
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$groups->links()}}
	</div>
</div>

<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center"><?php echo _('Edit Group'); ?></h5></div>
		<div class="panel-body">
			{{Form::model($current_group, array('url'=>route('group.update', $current_group->id), 'method'=>'put', 'class'=>'form-vertical'))}}
			<div class="form-group">
				{{Form::label('name', _('Group Name'), array('class'=>'control-label'))}}
				{{Form::text('name', Input::old('name'), array('class'=>'form-control input-sm'))}}

				@if($errors->has('name'))
					<p class="help-block"><span class="text-danger">{{$errors->first('name')}}</span></p>
				@endif
			</div>
			<div class="form-group text-right">
				<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
				<a href="{{route('group.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop