@extends('layout.main')
@section('content')


	<div class="col-md-7">

	@if(Session::has('delete'))
	<div class="alert alert-danger">
		{{Session::get('delete')}}
	</div>
	@endif

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th class="col-md-1">#</th>
				<th class="col-md-8">{{_('GROUP NAME')}}</th>
				<th class="col-md-3"></th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			@foreach($groups as $group)
			<tr {{($groupById->id == $group->id)?'class="success"':''}}>
				<td>{{++$i}}</td>
				<td>{{$group->name}}</td>
				<td>

					{{Form::open(array('url'=>'group/'.$group->id, 'method'=>'delete'))}}
					@if($groupById->id == $group->id)
					<a href="{{route('group.edit', array($group->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="Edit Group Name"><i class="fa fa-pencil"></i></a>
					@else
					<a href="{{route('group.edit', array($group->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Group Name"><i class="fa fa-pencil"></i></a>
					
					@endif
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
		<div class="panel-heading"><h5 class="text-center">{{_('EDIT GROUP')}}</h5></div>
		<div class="panel-body">
			{{Form::model($groupById, array('url'=>'group/'.$groupById->id, 'method'=>'put', 'class'=>'form-vertical'))}}

			<div class="form-group">
				{{Form::label('name', _('Group Name'), array('class'=>'control-label'))}}
				{{Form::text('name', Input::old('name'), array('class'=>'form-control input-sm'))}}
			</div>
			
			<!-- @if($errors->has('name'))
			<p class="help-block"><span class="text-danger">{{$errors->first('name')}}</span></p>
			@endif -->

			<div class="form-inline text-right">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-sm">{{_('Save')}}</button>
				</div>
				<div class="form-group">
					<a href="{{ URL::previous() }}"><span class="btn btn-primary btn-sm">{{_('Cancel')}}</span></a>
				</div>
			</div>	
			{{Form::close()}}
		</div>
	</div>
</div>
@stop