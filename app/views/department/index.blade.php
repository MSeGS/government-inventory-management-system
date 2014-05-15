@extends('layout.main')

@section('contentTop')
{{Form::open(array('url'=>route('department.index'),'method'=>'get','class'=>'form-vertical'))}}
	<div class="form-group">
		<div class="input-group">
			<?php echo Form::text('deptsearch',$filter['deptsearch'], array('class'=>'input-sm form-control','placeholder'=>_('Search Department')));?>
				<span class="input-group-btn">
				<button class="input-sm btn btn-default" name="search" value="Search" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
				</span>
		</div>
	</div>
{{Form::close()}}
@stop
@section('content')
<div class="row">
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
						<th class="col-md-5"><?php echo _("Department Name") ?></th>
						<th class="col-md-1"></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; ?>
					@foreach($departments as $department)
					<tr>
						<td>{{++$i}}</td>
						<td>{{$department->name}}</td>
						<td>
							{{Form::open(array('url'=>route('department.destroy', array($department->id)),'method'=>'delete'))}}

							<a href="{{route('department.edit', array($department->id, 'page='.$departments->getCurrentPage(), 'deptsearch='.$filter['deptsearch']))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Department"><i class="fa fa-pencil"></i></a>
							<button type="submit" onclick="return confirm('<?php echo _('Are you sure') ?>');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Department" value="{{$department->id}}"><i class="fa fa-times"></i></a>
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$departments->appends(array('fdeptsearch'=>$filter['deptsearch']))->links()}}
	</div>

	<div class="col-md-5">
		<div class="panel panel-default" >
			<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Add Department');?></h5></div>
				<div class="panel-body">

					@if(Session::has('message'))
					<div class="alert alert-success">
						{{Session::get('message')}}	
					</div>
					@endif

					{{Form::open(array('url'=>route('department.index'),'method'=>'post','class'=>'form-vertical'))}}
						
					
					<div class="form-group">
						<?php echo Form::label('name', _('Department Name'), array('class'=>'control-label'));?>
						{{Form::text('name', '',  array('class'=>'input-sm form-control'))}}

						@if($errors->has('name'))
						<p class="help-block"><span class="text-danger">{{$errors->first('name')}}</span></p>
						@endif
					</div>

					

					<div class="form-group text-right">
						<button type="submit" class="btn btn-sm btn-primary"><?php echo _('Submit');?></button>
					</div>
				</div>
		</div>
			{{Form::close()}}
	</div>
</div>
@stop