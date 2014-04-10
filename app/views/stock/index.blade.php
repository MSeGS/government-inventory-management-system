@extends('layout.main')
@section('content')

<div class="col-md-7">
	<div class="row">
		<div class="col-md-12">
			@if(Session::has('delete'))
			<div class="alert alert-danger">
				{{Session::get('delete')}}
			</div>
			@endif
			<table class="table table-striped table-bordered">
				<thead>
					<th class="col-md-1">#</th>
					<th class="col-md-3">Product</th>
					<th class="col-md-3">Note</th>
					<th class="col-md-2">Stock Quantity</th>
					<th></th>
				</thead>
				<tbody>
					<?php $i=0 ?>
					@foreach($stocks as $stock)
					<tr>
						<td>{{++$i}}</td>
						<td>{{$stock->product->name}} </td>
						<td>{{$stock->note}} </td>
						<td>{{$stock->quantity}}</td>
						<td>
							{{Form::open(array('url'=>route('stock.destroy', array($stock->id)), 'method'=>'delete'))}}
							<a href="{{route('stock.edit', array($stock->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Stock Quantity"><i class="fa fa-pencil"></i></a>
							<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove stock" value="{{$stock->id}}"><i class="fa fa-times"></i></a>
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>	
</div>

<div class="col-md-5">
	{{Form::open(array('url'=>route('stock.index'), 'method'=>'post', 'class'=>'form-vertical'))}}
	<div class="panel panel-default">
		<div class="panel-heading">
			@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}
			</div>
			@endif
			<h5 class="text-center"><?php echo _('Add Stock Quantity'); ?></h5>
		</div>
		<div class="panel-body">
			<div class="form-group">
				{{Form::label('product_name','Product', array('class'=>'control-label'))}}
				{{Form::select('product_name',$products, '', array('class'=>'form-control input-sm'))}}

				@if($errors->has('product_name'))
				<p class="help-block"><span class="text-danger">{{$errors->first('product_name')}}</span></p>
				@endif
			</div>
			<div class="form-group">
				{{Form::label('note', 'Note', array('class'=>'control-label'))}}
				{{Form::text('note', '', array('class'=>'form-control input-sm'))}}
			</div>
			<div class="form-group">
				{{Form::label('quantity', 'Stock Quantity', array('class'=>'control-label'))}}
				{{Form::text('quantity', Input::old('quantity'), array('class'=>'form-control input-sm'))}}

				@if($errors->has('quantity'))
				<p class="help-block"><span class="text-danger">{{$errors->first('quantity')}}</span></p>
				@endif
			</div>
			<div class="form-group text-right">
				{{Form::submit('Submit', array("class"=>"btn btn-primary btn-sm"))}}
			</div>
		</div>

	</div>
</div>

@stop