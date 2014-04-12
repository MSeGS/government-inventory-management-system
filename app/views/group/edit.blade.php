@extends('layout.main')
@section('content')


	<div class="col-md-8">

	@if(Session::has('delete'))
	<div class="alert alert-danger">
		{{Session::get('delete')}}
	</div>
	@endif

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th class="col-md-1">#</th>
				<th class="col-md-8"><?php echo _('GROUP NAME');?></th>
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
					@if($current_group->id == $group->id)
					<a href="{{route('group.edit', array($group->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="<?php echo _('Edit Group Name');?>"><i class="fa fa-pencil"></i></a>
					@else
					<a href="{{route('group.edit', array($group->id))}}" class="btn btn-xs btn-success tooltip-top" title="<?php echo _('Edit Group Name');?>"><i class="fa fa-pencil"></i></a>
					
					@endif
					<a href="{{route('group.permission', array($group->id))}}" class="btn btn-xs btn-primary tooltip-top" title="<?php echo _('Manage Group Permissions'); ?>"><i class="fa fa-cog"></i></a>
					<button type="submit" onclick="return confirm('<?php echo _('Are you sure'); ?>');" name="id" class="btn btn-xs btn-danger tooltip-top" title="<?php echo _('Remove Group'); ?>" value="{{$group->id}}"><i class="fa fa-times"></i></a>

					{{Form::close()}}	
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center"><?php echo _('EDIT GROUP'); ?></h5></div>
		<div class="panel-body">
			{{Form::model($current_group, array('url'=>route('group.edit', $current_group->id), 'method'=>'put', 'class'=>'form-vertical'))}}

			<div class="form-group">
				{{Form::label('name', _('Group Name'), array('class'=>'control-label'))}}
				{{Form::text('name', Input::old('name'), array('class'=>'form-control input-sm'))}}
			</div>
			
			<div class="form-inline text-right">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
				</div>
				<div class="form-group">
					<a href="{{route('group.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
				</div>
			</div>	
			{{Form::close()}}
		</div>
	</div>
</div>
@stop