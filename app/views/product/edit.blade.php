@extends('layout.main')

@section('content')

<div class="col-md-7">
@if(Session::has('delete'))
<div class="alert alert-danger">
	{{Session::get('delete')}}
</div>
@endif


	<div class="col-md-12">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-2"><?php echo _('Name') ?></th>
					<th class="col-md-3"><?php echo _('Description') ?></th>
					<th class="col-md-2"><?php echo _('Reserved Amount'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0 ?>
				@foreach($products as $product)
				<tr {{($productById->id == $product->id)?'class="success"':''}}>
					<td class="col-md-1">
						 {{++$i}} 
					</td>
					<td class="col-md-2">
						{{$product->name}}
					</td>
					<td class="col-md-2">
						{{$product->description}}
					</td>
					<td class="col-md-2">
						{{$product->reserved_amount}}
					</td>
					<td class="col-md-2">
					{{Form::open(array('url'=>'product/'.$product->id, 'method'=>'delete'))}}
					@if($productById->id == $product->id)
					<a href="{{route('product.edit', array($product->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="Edit product Name"><i class="fa fa-pencil"></i></a>
					@else
					<a href="{{route('product.edit', array($product->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Product Name"><i class="fa fa-pencil"></i></a>
					
					@endif
					<button type="submit" onclick="" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Product" value="{{$product->id}}"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>


<div class="col-md-5">
		{{Form::model($productById, array('url'=>'/product/'.$productById->id, 'method'=>'put', 'class'=>'form-vertical'))}}				
	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="text-center">Edit Product</h5>
		</div>
		<div class="panel-body">
				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}
				</div>
				@endif
			<div class="form-group">
				{{Form::label('product_name', 'Product Name',array('control-label'))}}
				{{Form::text('name', Input::old('name'), array('class'=>'form-control input-sm'))}}
			</div>
				@if($errors->has('name'))
				<p class="help-block"><span class="text-danger">{{$errors->first('name')}}</span></p>
				@endif
			<div class="form-group">
				{{Form::label('description', 'Description (Optional)',array('control-label'))}}
				{{Form::text('description', Input::old('name'), array('class'=>'form-control input-sm'))}}
			</div>
			<div class="form-group">
				{{Form::label('reserved_amount', 'Reserved Amount',array('control-label'))}}
				{{Form::text('reserved_amount', Input::old('name'), array('class'=>'form-control input-sm'))}}
			</div>
			@if($errors->has('reserved_amount'))
			<p class="help-block"><span class="text-danger">{{$errors->first('reserved_amount')}}</span></p>
			@endif
			<div class="form-inline text-right">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
				</div>
				<div class="form-group">
					<a href="{{route('product.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
				</div>
			</div>	

		</div>
	</div>
</div>
@stop