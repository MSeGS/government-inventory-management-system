@extends('layout.main')

@section('content')

<div class="col-md-7">
	<div class="row">
		@if(Session::has('delete'))
		<div class="alert alert-danger">
			{{Session::get('delete')}}
		</div>
		@endif

		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th><?php echo _('Category Name'); ?></th>
					<th class="col-md-2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($categories as $key=>$category)
				<tr {{($categoryById->id == $category->id)?'class="success"':''}}>
					<td>
						{{$index+$key}}
					</td>
					<td>
						{{$category->category_name}}
					</td>
					<td>
						@if(!($category->id == 1 || $category->id == "Uncategorized"))
						
						{{Form::open(array('url'=>'category/'.$category->id, 'method'=>'delete'))}}
						@if($categoryById->id == $category->id)
						<a href="{{route('category.edit', array($category->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="Edit Category Name"><i class="fa fa-pencil"></i></a>
						@else
						<a href="{{route('category.edit', array($category->id, 'page='. $categories->getCurrentPage()))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Category Name"><i class="fa fa-pencil"></i></a>
						@endif
						<button type="submit" onclick="return confirm('<?php echo _('Are you sure?') ?>');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Category" value="{{$category->id}}"><i class="fa fa-times"></i></a>
						{{Form::close()}}	

						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$categories->links()}}
	</div>
</div>

<div class="col-md-5">
	{{Form::model($categoryById, array('url'=>route('category.update', $categoryById->id), 'method'=>'put', 'class'=>'form-vertical'))}}				
	<div class="panel panel-default">
		<div class="panel-heading text-center">
			<h5><?php echo _('Edit Category') ?></h5>
		</div>
			<div class="panel-body">
				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}
				</div>
				@endif
				<div class="form-group">
					{{Form::label('category_name', _('Category Name'),array('control-label'))}}
					{{Form::text('category_name', Input::old('category_name'), array('class'=>'form-control input-sm'))}}	
				</div>
				@if($errors->has('category_name'))
				<p class="help-block"><span class="text-danger">{{$errors->first('category_name')}}</span></p>
				@endif

				<div class="form-group text-right">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
					<a href="{{route('category.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
				</div>	
			</div>
	</div>
	{{Form::close()}}
</div>
@stop