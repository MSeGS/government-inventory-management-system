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
				<tr>
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
						<a href="{{route('product.edit', array($product->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit product Name"><i class="fa fa-pencil"></i></a>
						<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove product" value="{{$product->id}}"><i class="fa fa-times"></i></a>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>


<div class="col-md-5">
		{{Form::open(array('url'=>'/product', 'method'=>'post', 'class'=>'form-vertical'))}}				
	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="text-center">New Product</h5>
		</div>
		<div class="panel-body">
			@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}
			</div>
			@endif
			<div class="form-group">
				{{Form::label('product_name', 'Product Name',array('control-label'))}}
				{{Form::text('name', '', array('class'=>'form-control input-sm'))}}
			</div>
				@if($errors->has('name'))
				<p class="help-block"><span class="text-danger">{{$errors->first('name')}}</span></p>
				@endif
			<div class="form-group">
				{{Form::label('description', 'Description (Optional)',array('control-label'))}}
				{{Form::text('description', '', array('class'=>'form-control input-sm'))}}
			</div>
			<div class="form-group">
				{{Form::label('reserved_amount', 'Reserved Amount',array('control-label'))}}
				{{Form::text('reserved_amount', '', array('class'=>'form-control input-sm'))}}
			</div>
			@if($errors->has('reserved_amount'))
			<p class="help-block"><span class="text-danger">{{$errors->first('reserved_amount')}}</span></p>
			@endif
			<div class="form-group text-right">
				{{Form::submit('Submit', array("class"=>"btn btn-primary btn-sm"))}}
			</div>

		</div>
	</div>
</div>
@stop