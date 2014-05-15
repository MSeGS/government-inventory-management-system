@extends('layout.main')
@section('content')
<div class="row">
	<div class="col-md-8">
		@if(Session::has('delete'))
		<div class="alert alert-danger">
			{{Session::get('delete')}}
		</div>
		@endif
		<table class="table table-striped table-bordered">
			<thead>
				<th>#</th>
				<th class="col-md-5">Product</th>
				<th class="col-md-2">Quantity</th>
				<th class="col-md-3">Date</th>
				<th class="col-md-2"></th>
			</thead>
			<tbody>
				<?php $i=0 ?>
				@foreach($stocks as $stock)
				<tr {{($stockById->id == $stock->id)?'class="success"':''}}>
					<td>{{++$i}}</td>
					<td>
						{{$stock->product->name}}<br>
						<span class="text-muted">{{$stock->category->category_name}}</span>
					</td>
					<td>{{$stock->quantity}}</td>
					<td>{{date('d/m/Y, h:iA', strtotime($stock->created_at))}}</td>
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
		{{$stocks->links()}}
	</div>	

	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="text-center"><?php echo _('Edit Stock Quantity'); ?></h5>
			</div>
			<div class="panel-body">
				{{Form::model($stockById, array('url'=>route('stock.update', $stockById->id), 'method'=>'put', 'class'=>'form-vertical'))}}
				<div class="form-group">
					{{Form::label('category_name','Category', array('class'=>'control-label'))}}
					{{Form::select('category_name',$categories,$stockById->category_id, array('class'=>'form-control input-sm'))}}
				</div>
				<div class="form-group">
					{{Form::label('product_name','Product', array('class'=>'control-label'))}}
					{{Form::select('product_name',$products, $stockById->product_id, array('class'=>'form-control input-sm'))}}
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
</div>

@stop

@section('scripts')
<script type="text/javascript">
$(function(){
	populate_product('load');

	$('#category_name').on('change', function(){
		populate_product('');
	});
});

function populate_product(status) {
	var html = '<option value="">Select Product</option>';
	if($('#category_name').val() != 0 && $('#category_name').val() != "") {
		
		$('#product_name').html('<option value="">Loading...</option>');

		$.get("{{route('product.index')}}?category=" + $('#category_name').val(), function(data){
			$.each(data, function(index, product){
				html += '<option value="'+product['id']+'">'+product['name']+'</option>';
			});
		})
		.done(function() {
			$('#product_name').html(html);
			if(status == 'load')
				$('#product_name').val({{$stockById->product_id}});
		});
	}
	else
		$('#product_name').html(html);

}
</script>
@stop