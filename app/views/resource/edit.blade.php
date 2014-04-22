@extends('layout.main')
@section('content')

<div class="col-md-8">
	<div class="row">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-5"><?php echo _('Resource Name') ?></th>
					<th class="col-md-3"><?php echo _('Resource Route') ?></th>
					<th class="col-md-3"></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; ?>
				@foreach($resources as $resource)
				<tr {{($resourceById->id == $resource->id)?'class="success"':''}}>
					<td>{{++$i}}</td>
					<td>{{$resource->name}}</td>
					<td>{{$resource->route}}</td>
					<td>
						{{Form::open(array('url'=>route('resource.destroy',$resource->id), 'method'=>'delete'))}}
						<?php if($resource->id == $resourceById->id){ ?>
							<a href="{{route('resource.edit', array($resource->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="Edit Resource"><i class="fa fa-pencil"></i></a>
						<?php } else { ?>
							<a href="{{route('resource.edit', array($resource->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Resource"><i class="fa fa-pencil"></i></a>
						<?php } ?>
						<button type="submit" onclick="return confirm(<?php echo _('Are you sure') ?>);" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Resource" value="{{$resource->id}}"><i class="fa fa-times"></i></a>
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
		<div class="panel-heading"><h5 class="text-center">Edit Resource</h5></div>
		<div class="panel-body">
			{{Form::model($resourceById, array('url'=>route('resource.update', $resourceById->id), 'method'=>'put', 'class'=>'form-vertical'))}}

			<div class="form-group">
				{{Form::label('name', <?php echo _('Resource Name') ?>, array('class'=>'control-label'))}}
				{{Form::text('name', Input::old('name'), array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-group">
				{{Form::label('route', <?php echo _('Resource Route') ?>, array('class'=>'control-label'))}}
				{{Form::text('route', Input::old('route'), array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-inline text-right">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
				</div>
				<div class="form-group">
					<a href="{{route('resource.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
				</div>
			</div>	

			{{Form::close()}}
		</div>
	</div>
</div>
@stop