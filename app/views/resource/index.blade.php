@extends('layout.main')

@section('contentTop')
	<div class="col-md-3">
		{{Form::open(array('url'=>route('resource.index'),'method'=>'get','class'=>'form-vertical'))}}
		<div class="form-group">
			<div class="input-group">
				{{Form::text('name', $filter['name'], array('class'=>'form-control input-sm','placeholder'=>'Search Resource'))}}
					<span class="input-group-btn">
					<button class="btn btn-default btn-sm" name="search" value="Search" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
					</span>
			</div>
		</div>
		{{Form::close()}}
	</div>
@stop
@section('content')
<div class="row">
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
						<th class="col-md-5"><?php echo _('Resource Name') ?></th>
						<th class="col-md-3"><?php echo _('Resource Route') ?></th>
						<th class="col-md-3"></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; ?>
					@foreach($resources as $key=>$resource)
					<tr>
						<td>{{$index+$key}}</td>
						<td>{{$resource->name}}</td>
						<td>{{$resource->route}}</td>
						<td>
							{{Form::open(array('url'=>route('resource.destroy',$resource->id), 'method'=>'delete'))}}
							@if($current_user->hasAccess('resoource.edit'))
							<a href="{{route('resource.edit', array($resource->id, 'page='.$resources->getCurrentPage(), 'name='.$filter['name']))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Resource"><i class="fa fa-pencil"></i></a>
							@endif
							<button type="submit" onclick="return confirm('<?php echo _('Are you sure') ?>');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Resource" value="{{$resource->id}}"><i class="fa fa-times"></i></a>
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		{{$resources->appends(array('name'=>$filter['name']))->links()}}
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading"><h5 class="text-center"><?php echo _('New Resource') ?></h5></div>
			<div class="panel-body">
				{{Form::open(array('url'=>route('resource.index'), 'method'=>'post', 'class'=>'form-vertical'))}}
				@if(Session::has('message'))
					<div class="alert alert-success">
						{{Session::get('message')}}	
					</div>
				@endif
				<div class="form-group">
					{{Form::label('name', _('Resource Name'), array('class'=>'control-label'))}}
					{{Form::text('name', '', array('class'=>'form-control input-sm'))}}

					@if($errors->has('name'))
					<p class="help-block"><span class="text-danger">{{$errors->first('name')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					{{Form::label('route', _('Resource Route'), array('class'=>'control-label'))}}
					{{Form::text('route', '', array('class'=>'form-control input-sm'))}}

					@if($errors->has('route'))
					<p class="help-block"><span class="text-danger">{{$errors->first('route')}}</span></p>
					@endif
				</div>

				<div class="form-group text-right">
					<button type="submit" name="submit" class="btn btn-primary btn-sm pull-right">{{_('Submit')}}</button>
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>
@stop