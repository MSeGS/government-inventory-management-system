@extends('layout.main')

@section('content')
<div class="col-md-6">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				{{Form::open(array('url'=>route('indent.store'), 'method'=>'post', 'class'=>'form-vertical'))}}
					<div class="col-md-3">
						<div class="form-group">
							{{Form::select('limit', array(10=>10, 20=>20, 30=>30, 40=>40, 50=>50), $filter['limit'], array('class' =>'dropdown input-sm form-control'))}}
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							{{Form::select('category', array('0'=>'All Categories')+ $categories, $filter['category_id'], array('class' =>'dropdown input-sm form-control'))}}
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<div class="input-group">
								{{Form::text('name', $filter['name'], array('class'=>'form-control input-sm','placeholder'=>'Search Product'))}}
			      				<span class="input-group-btn">
			        				<button class="btn btn-default btn-sm" name="search" value="Search" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
			      				</span>
				    		</div>
						</div>
					</div>
				{{Form::close()}}
			</div>
		</div>

		<div class="col-md-12 product-list">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-md-1">#</th>
						<th>
							<?php echo _('Name') ?>
						</th>
						<th class="col-md-3"><?php echo _('Stock / Reserved'); ?></th>
						<th class="col-md-2"><?php echo _('Quantity'); ?></th>
						<th class="col-md-1"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $key=>$product)
					<tr id="product_{{$product->id}}">
						<td>
							<input type="hidden" class="id" name="product[{{$product->id}}]" value="{{$product->id}}" />
							<input type="hidden" class="stock" name="stock[{{$product->id}}]" value="{{get_product_stock($product->id)}}" />
							<input type="hidden" class="reserved" name="reserved[{{$product->id}}]" value="{{$product->reserved_amount}}" />
							<input type="hidden" class="name" name="name[{{$product->id}}]" value="{{$product->name}}" />
							{{$index+$key}}
						</td>
						<td>
							{{$product->name}}
							
							@if(strlen($product->description))
							<br>
							<small>{{$product->description}}</small>
							@endif
						</td>
						<td>
							{{get_product_stock($product->id)}} / <span>{{$product->reserved_amount}}</span>
						</td>
						<td><input type="number" name="qty[{{$product->id}}]" value="" id="quantity_{{$product->id}}" min="0" class="quantity input-sm form-control" /></td>
						<td>
							@if(get_product_stock($product->id) == 0)
							<?php echo Form::button('<i class="fa fa-shopping-cart"></i>', array('class'=>'btn btn-sm btn-warning tooltip-right request', 'title'=>_('Request Item')));?>
							@else
							<?php echo Form::button('<i class="fa fa-shopping-cart"></i>', array('class'=>'btn btn-sm btn-success tooltip-right add', 'title'=>_('Indent Item')));?>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			{{$products->appends(array('limit'=>'10', 'category_id'=>$filter['category_id'],'name'=>$filter['name']))->links()}}
		</div>
	</div>
</div>

<div class="col-md-6 chit-form">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="text-center"><?php echo _('Chit Form'); ?></h5>
		</div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-4"><?php echo _('Name'); ?></th>
					<th class="col-md-1"><?php echo _('Quantity'); ?></th>
					<th class="col-md-4"><?php echo _('Note'); ?></th>
					<th class="col-md-1 text-right"></th>
				</tr>
			</thead>
			<tbody>
				<tr class="empty">
					<td colspan="5" align="center">
						<em><?php echo _('Browse items from left column and add here'); ?></em>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="panel-body">
			<hr> 
			<div class="col-md-3">
				<p><span class="label label-success">&nbsp;</span> <span class="text-muted"><?php echo _('Indents');?></span></p>
			</div>
			<div class="col-md-3">
				<p><span class="label label-warning">&nbsp;</span> <span class="text-muted"><?php echo _('Requirements');?></span></p>
			</div>
			<div class="col-md-6 text-right">
				<a href="/sad-proto/chit.php" class="btn btn-primary"><i class="fa fa-check"></i> <?php echo _('Submit Indent'); ?></a>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
$(function(){
	$('.product-list button.add, .product-list button.request').on('click', function(){
		var btn = $(this);
		var productRow = btn.closest('tr');
		var id = parseInt(productRow.find('.id').val());
		var stock = parseInt(productRow.find('.stock').val());
		var reserved = parseInt(productRow.find('.reserved').val());
		var qty = productRow.find('.quantity').val() != ""?parseInt(productRow.find('.quantity').val()):0;
		var name = productRow.find('.name').val();
		var noOfRows = parseInt($('.chit-form table tbody tr').size());
		var indented = ($("#indent_" + id).size())?$("#indent_" + id).val():0;
		var requested = ($("#request_" + id).size())?$("#request_" + id).val():0;
		
		// Button loader
		btn.html('<i class="fa fa-spinner spin"></i>');
		setTimeout(function(){
			btn.html('<i class="fa fa-shopping-cart"></i>');
		}, 250);

		var row = "<td>"+(noOfRows)+"</td>";
		row += "<td>"+name+"</td>";

		if(stock == 0) {
			row = '<tr class="warning">' + row;
			row += '<td><input class="input-sm form-control" type="text" id="request_'+id+'" name="request['+id+']" value="'+qty+'" /></td>';
			row += '<td><textarea class="input-sm form-control" rows="3"></textarea></td>';
			row += '<td class="text-right"><span class="text-danger"><i class="fa fa-times"></i></span></td>';
			row += "</tr>";
			
			addToChit(id, 'request', qty, row);
		}
		else if(stock < qty) {
			var toIndent = parseInt(stock) - parseInt(indented);
			if(toIndent > 0) {
				var indentRow = '<tr class="success">' + row;
				indentRow += '<td><input class="input-sm form-control" id="indent_'+id+'" type="text" name="indent['+id+']" value="'+stock+'" /></td>';
				indentRow += "<td></td>";
				indentRow += '<td class="text-right"><span class="text-danger"><i class="fa fa-times"></i></span></td>';
				indentRow += "</tr>";

				addToChit(id, 'indent', stock, indentRow);
			}

			var toRequest = parseInt(qty) - parseInt(toIndent);
			if(toRequest) {
				var requestRow  = '<tr class="warning">' + row;
				requestRow += '<td><input class="input-sm form-control" id="request_'+id+'" type="text" name="request['+id+']" value="'+toRequest+'" /></td>';
				requestRow += '<td><textarea class="input-sm form-control" rows="3"></textarea></td>';
				requestRow += '<td class="text-right"><span class="text-danger"><i class="fa fa-times"></i></span></td>';
				requestRow += "</tr>";
				
				addToChit(id, 'request', toRequest, requestRow);
			}
			
		}
		else {
			row = '<tr class="success">' + row;
			row += '<td><input class="input-sm form-control" type="text" id="indent_'+id+'" name="indent['+id+']" value="'+qty+'" /></td>';
			row += "<td></td>";
			row += '<td class="text-right"><span class="text-danger"><i class="fa fa-times"></i></span></td>';
			row += "</tr>";

			addToChit(id, 'indent', qty, row);
		}

		productRow.find('.quantity').val('');
	});
});

function addToChit(id, rowType, qty, row)
{	
	$(".product-list input").removeAttr('style');
	if(qty == 0) {
		$("#quantity_" + id).css('border-color', 'red');
		return false;
	}

	var insert = true;

	if(rowType == 'indent') {
		var rowExist = $("#indent_" + id).size();
		if(rowExist) {
			insert = false;
			var indented = parseInt($("#indent_" + id).val());
			$("#indent_" + id).val(indented + parseInt(qty));
		}
	}
	else if(rowType == 'request') {
		var rowExist = $("#request_" + id).size(); 
		if(rowExist) {
			insert = false;
			var requested = $("#request_" + id).val();
			$("#request_" + id).val(parseInt(requested) + parseInt(qty));
		}
	}
	
	if(insert)
		$('.chit-form table tbody').append(row);

	if($('.chit-form table tbody tr').size() > 1)
		$('.chit-form table tbody tr.empty').hide();	
}
</script>
@stop