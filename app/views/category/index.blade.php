@extends('layout.main')

@section('content')

<div class="col-md-7">
@if(Session::has('delete'))
<div class="alert alert-danger">
	{{Session::get('delete')}}
</div>
@endif


	<div class="col-md-8">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-3">Category Name</th>
				</tr>
			</thead>
			<tbody>
					<?php $i=0; ?>
				@foreach ($categories as $category)
				<tr>
					<td class="col-md-1">
						{{++$i}}
					</td>
					<td class="col-md-3">
						{{$category->category_name}}
					</td>
					<td class="col-md-2">
						{{Form::open(array('url'=>'category/'.$category->id, 'method'=>'delete'))}}
						<a href="{{route('category.edit', array($category->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Category Name"><i class="fa fa-pencil"></i></a>
						<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Category" value="{{$category->id}}"><i class="fa fa-times"></i></a>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>


<div class="col-md-5">
	{{Form::open(array('url'=>'/category', 'method'=>'post', 'class'=>'form-vertical'))}}				
	<div class="panel panel-default">
		<div class="panel-heading text-center" >
			<h5 >New Category</h5>
		</div>
			<div class="panel-body">
				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}
				</div>
				@endif
				<div class="form-group">
					{{Form::label('category_name', 'Category Name',array('control-label'))}}
					{{Form::text('category_name', '', array('class'=>'form-control input-sm'))}}	
				</div>
				@if($errors->has('cateogory_name'))
				<p class="help-block"><span class="text-danger">{{$errors->first('category_name')}}</span></p>
				@endif
				<div class="form-group text-right">
					{{Form::submit('Submit', array("class"=>"btn btn-primary btn-sm"))}}
				</div>
			</div>
	</div>
	{{Form::close()}}
</div>
@stop