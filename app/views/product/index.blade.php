@extends('layout.main')

@section('content')

<div class="col-md-12">
	<div class="row">
		@if(Session::has('delete'))
		<div class="alert alert-danger">
			{{Session::get('delete')}}
		</div>
		@endif
		@if(Session::has('message'))
		<div class="alert alert-success">
			{{Session::get('message')}}
		</div>
		@endif

		<div class="col-md-12">
			<div class="row">
				{{Form::open(array('url'=>route('product.index'),'method'=>'get','class'=>'form-vertical'))}}
					<div class="col-md-2">
						<div class="form-group">
							{{Form::select('category', array('0'=>'All Categories')+ $categories, $filter['category_id'], array('class' =>'dropdown input-sm form-control'))}}
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<div class="input-group">
								{{Form::text('name', $filter['name'], array('class'=>'form-control','placeholder'=>'Search Product'))}}
			      				<span class="input-group-btn">
			        				<button class="btn btn-default" name="search" value="Search" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
			      				</span>
				    		</div>
						</div>
					</div>
					<div class="col-md-2 pull-right text-right">
						<a href="{{route('product.create')}}" class="btn btn-primary btn-sm"><?php echo _('Add New Product') ?></a>
					</div>
				{{Form::close()}}
			</div>
				{{$products->links()}}
		</div>

		<div class="col-md-12">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-md-1">#</th>
						<th><?php echo _('Name') ?></th>
						<th class="col-md-2"><?php echo _('Category') ?></th>
						<th class="col-md-3"><?php echo _('Description') ?></th>
						<th class="col-md-1"><?php echo _('Reserved'); ?></th>
						<th class="col-md-1"><?php echo _('Stock'); ?></th>
						<th class="col-md-1"></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; ?>
					@foreach($products as $key=>$product)
					<tr>
						<td>{{( $products->getPerPage() * ($products->getCurrentPage()-1) ) + (++$key) }} </td>
						<td>{{$product->name}}</td>
						<td>{{$product->category->category_name}}</td>
						<td>{{$product->description}}</td>
						<td>{{$product->reserved_amount}}</td>
						<td>{{Product::stock($product->id)}}</td>
						<td>
							{{Form::open(array('url'=>route('product.destroy', array($product->id)), 'method'=>'delete'))}}
							<a href="{{route('product.edit', array($product->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit product Name"><i class="fa fa-pencil"></i></a>
							<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove product" value="{{$product->id}}"><i class="fa fa-times"></i></button>
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop