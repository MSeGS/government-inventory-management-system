@extends('layout.main')

@section('content')
<div class="col-md-12">
	<div class="col-md-7">
			@if(Session::has('delete'))
			<div class="alert alert-danger">
			{{Session::get('delete')}}	
			@endif
		{{Form::open(array('url'=>route('department.index'),'method'=>'get','class'=>'form-vertical'))}}
				<div class="form-group">
					<div class="input-group">
						{{Form::text('username', '', array('class'=>'input-sm form-control','placeholder'=>'Search Department'))}}
	      				<span class="input-group-btn">
	        				<button class="input-sm btn btn-default" name="search" value="Search" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
	      				</span>
		    		</div>
				</div>
		{{Form::close()}}
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
					<tr{{($departmentById->id == $department->id)?'class="success"':''}}>
						<td>{{++$i}}</td>
						<td>{{$department->name}}</td>
						<td>
							{{Form::open(array('url'=>'department/'.$department->id, 'method'=>'delete'))}}
							<?php if($department->id == $departmentById->id){ ?>
								<a href="{{route('department.edit', array($department->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="Edit Department"><i class="fa fa-pencil"></i></a>
							<?php } else { ?>
								<a href="{{route('department.edit', array($department->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Resource"><i class="fa fa-pencil"></i></a>
							<?php } ?>
							<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Resource" value="{{$department->id}}"><i class="fa fa-times"></i></a>
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$departments->links()}}
	</div>

	<div class="col-md-5">
		<div class="panel panel-default" >
			<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Edit Department');?></h5></div>
				<div class="panel-body">
					@if(Session::has('message'))
					<div class="alert alert-success">
						{{Session::get('message')}}	
					</div>
					@endif
					{{Form::model($departmentById, array('url'=>'department/'.$departmentById->id, 'method'=>'put', 'class'=>'form-vertical'))}}
					
					<div class="form-group">
						{{Form::label('name', _('Department Name'), array('class'=>'control-label'))}}
						{{Form::text('name', $departmentById->name,  array('class'=>'input-sm form-control'))}}

						@if($errors->has('name'))
						<p class="help-block"><span class="text-danger">{{$errors->first('name')}}</span></p>
						@endif
					</div>

					<div class="form-inline text-right">
						<div class="form-group">
							<button type="submit" class="btn btn-sm btn-primary"><?php echo _('Save');?></button>
						</div>
						
						<div class="form-group">
							<a href="{{route('department.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
						</div>
					</div>
				</div>
			{{Form::close()}}
	</div>
</div>
@stop