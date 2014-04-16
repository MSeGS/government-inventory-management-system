@extends('layout.main')

@section('content')

<div class="col-md-8" >
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
					<th><?php echo _('Name') ?></th>
					<th class="col-md-2"><?php echo _('Category') ?></th>
					<th class="col-md-2"><?php echo _('Reserved'); ?></th>
					<th class="col-md-2"><?php echo _('Stock'); ?></th>
					<th class="col-md-2"></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0 ?>
				@foreach($products as $product)
				<tr {{($productById->id == $product->id)?'class="success"':''}}>
					<td>{{++$i}}</td>
					<td>{{$product->name}}</td>
					<td>{{$product->category->category_name}}</td>
					<td>{{$product->reserved_amount}}</td>
					<td>{{$product->stock($product->id)}}</td>
					<td>
						{{Form::open(array('url'=>route('product.destroy'), 'method'=>'delete'))}}
							@if($productById->id == $product->id)
							<a href="{{route('product.edit', array($product->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="Edit product Name"><i class="fa fa-pencil"></i></a>
							@else
							<a href="{{route('product.edit', array($product->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Product Name"><i class="fa fa-pencil"></i></a>
							@endif
							<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Product" value="{{$product->id}}"><i class="fa fa-times"></i></button>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$products->links()}}
	</div>
</div>


<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="text-center">Edit Product</h5>
		</div>
		<div class="panel-body">
			{{Form::model($productById, array('url'=>route('product.update', $productById->id), 'method'=>'put', 'class'=>'form-vertical'))}}
				
				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}
				</div>
				@endif
				
				<div class="form-group">
					{{Form::label('product_name', 'Product Name',array('control-label'))}}
					{{Form::text('name', Input::old('name'), array('class'=>'form-control input-sm'))}}
					@if($errors->has('name'))
					<p class="help-block"><span class="text-danger">{{$errors->first('name')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					{{Form::label('description', 'Description (Optional)',array('control-label'))}}
					{{Form::text('description', Input::old('name'), array('class'=>'form-control input-sm'))}}
				</div>

				<div class="form-group">
					{{Form::label('reserved_amount', 'Reserved Amount',array('control-label'))}}
					{{Form::text('reserved_amount', Input::old('name'), array('class'=>'form-control input-sm'))}}
					
					@if($errors->has('reserved_amount'))
					<p class="help-block"><span class="text-danger">{{$errors->first('reserved_amount')}}</span></p>
					@endif
				</div>
				<div class="form-group text-right">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
					<a href="{{route('product.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop