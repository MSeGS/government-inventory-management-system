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
					<th><?php echo _('Category Name') ?></th>
					<th class="col-md-2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($categories as $key=>$category)
				<tr>
					<td>
						{{$index+$key}}
					</td>
					<td>
						{{$category->category_name}}
					</td>
					<td>
						@if(!($category->id == 1 || $category->id == "Uncategorized"))
						{{Form::open(array('url'=>route('category.destroy', array($category->id)), 'method'=>'delete'))}}
						<a href="{{route('category.edit', array($category->id, 'page='.$categories->getCurrentPage()))}}" class="btn btn-xs btn-success tooltip-top" title="<?php echo _('Edit Category Name');?>"><i class="fa fa-pencil"></i></a>
						<button type="submit" onclick="return confirm('<?php echo _('Are you sure you want to delete? If you delete this category, all products under this category will be moved to Uncategorized.');?>');" name="id" class="btn btn-xs btn-danger tooltip-top" title="<?php echo _('Remove Category');?>" value="{{$category->id}}"><i class="fa fa-times"></i></a>
						{{Form::close()}}
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>


<div class="col-md-5">
	{{Form::open(array('url'=>route('category.index'), 'method'=>'post', 'class'=>'form-vertical'))}}				
	<div class="panel panel-default">
		<div class="panel-heading text-center" >
			<h5 ><?php echo _('New Category') ?></h5>
		</div>
			<div class="panel-body">
				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}
				</div>
				@endif
				<div class="form-group">
					{{Form::label('category_name', _('Category Name'),array('control-label'))}}
					{{Form::text('category_name', Input::old('category'), array('class'=>'form-control input-sm'))}}	
					
					@if($errors->has('category_name'))
					<p class="help-block"><span class="text-danger">{{$errors->first('category_name')}}</span></p>
					@endif
				</div>

				<div class="form-group text-right">
					{{Form::submit(_('Submit'), array("class"=>"btn btn-primary btn-sm"))}}
				</div>
			</div>
	</div>
	{{Form::close()}}
</div>
@stop