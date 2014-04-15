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
					<tr {{($stockById->id == $stock->id)?'class="success"':''}}>
						<td>{{++$i}}</td>
						<td>{{$stock->product->name}} </td>
						<td>{{$stock->note}} </td>
						<td>{{$stock->quantity}}</td>
						<td>
							{{Form::open(array('url'=>route('stock.destroy', array($stock->id)), 'method'=>'delete'))}}
							@if($stockById->id == $stock->id)
							<a href="{{route('stock.edit', array($stock->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="Edit Stock Quantity"><i class="fa fa-pencil"></i></a>
							@else
							<a href="{{route('stock.edit', array($stock->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Stock Quantity"><i class="fa fa-pencil"></i></a>
							@endif
							<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove stock" value="{{$stock->id}}"><i class="fa fa-times"></i></button>
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
	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="text-center"><?php echo _('Edit Stock Quantity'); ?></h5>
		</div>
		<div class="panel-body">
			{{Form::model($stockById, array('url'=>route('stock.update', $stockById->id), 'method'=>'put', 'class'=>'form-vertical'))}}
			<div class="form-group">
				{{Form::label('product_name','Product', array('class'=>'control-label'))}}
				{{Form::select('product_name',$products, Input::old('product_name'), array('class'=>'dropdown form-control input-sm'))}}
			</div>
			<div class="form-group">
				{{Form::label('note', 'Note', array('class'=>'control-label'))}}
				{{Form::text('note', Input::old('note'), array('class'=>'form-control input-sm'))}}
			</div>
			<div class="form-group">
				{{Form::label('quantity', 'Stock Quantity', array('class'=>'control-label'))}}
				{{Form::text('quantity', Input::old('quantity'), array('class'=>'form-control input-sm'))}}

				@if($errors->has('quantity'))
				<p class="help-block"><span class="text-danger">{{$errors->first('quantity')}}</span></p>
				@endif
			</div>
			<div class="form-group text-right">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
					<a href="{{route('stock.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>

@stop