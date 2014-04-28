@extends('layout.main')

@section('content')
<div class="create-indent-page">
	<div class="col-sm-6">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					{{Form::open(array('url'=>route('indent.create'), 'method'=>'get', 'id'=>'indent_filter', 'class'=>'form-vertical'))}}
						<div class="col-sm-3">
							<div class="form-group">
								{{Form::select('limit', array(10=>10, 30=>30, 40=>40, 50=>50, 100=>100, 150=>150, 200=>200), $filter['limit'], array('class' =>'dropdown input-sm form-control', 'onchange'=>'document.getElementById("indent_filter").submit()'))}}
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group">
								{{Form::select('category', array('0'=>'All Categories')+ $categories, $filter['category_id'], array('class' =>'dropdown input-sm form-control'))}}
							</div>
						</div>
						<div class="col-sm-5">
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

			<div class="col-sm-12 product-list">
				<div class="table-wrapper">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="col-sm-1">#</th>
								<th class="col-sm-5"><?php echo _('Name') ?></th>
								<th class="col-sm-3"><?php echo _('Stock / Reserved'); ?></th>
								<th class="col-sm-2"><?php echo _('Quantity'); ?></th>
								<th class="col-sm-1"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $key=>$product)
							<tr id="product_{{$product->id}}">
								<td>
									<input type="hidden" class="id" name="product[{{$product->id}}]" value="{{$product->id}}" />
									<input type="hidden" class="category" name="category[{{$product->id}}]" value="{{$product->category_id}}" />
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
									<?php echo Form::button('<i class="fa fa-shopping-cart"></i>', array('class'=>'btn btn-sm btn-warning request', 'title'=>_('Request Item')));?>
									@else
									<?php echo Form::button('<i class="fa fa-shopping-cart"></i>', array('class'=>'btn btn-sm btn-success add', 'title'=>_('Indent Item')));?>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				{{$products->appends(array('limit'=>$filter['limit'], 'category_id'=>$filter['category_id'],'name'=>$filter['name']))->links()}}
			</div>
		</div>
	</div>

	<div class="col-sm-6 chit-form">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="text-center">
					<span class="saving text-muted pull-left hidden">saving...</span>
					<span class="saved text-success pull-left hidden">saved</span>
					<?php echo _('Chit Form'); ?>
				</h5>
			</div>
			<div class="panel-body">
				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}	
				</div>
				@endif

				<?php
				$chit = Cookie::get('chit');
				$ctr = 0;
				?>

				{{Form::open(array('url'=>route('indent.store'), 'method'=>'post', 'class'=>'form-vertical'))}}
					
					{{Form::hidden('chit_size', $chit_size, array('id'=>'chit_size'))}}
					
					<table class="table table-hover">
						<thead>
							@if(is_array($chit) && array_key_exists('chit', $chit) && !empty($chit['chit']))
							<tr>
							@else
							<tr class="hidden">
							@endif
								<th class="col-sm-1">#</th>
								<th class="col-sm-3"><?php echo _('Name'); ?></th>
								<th class="col-sm-2"><?php echo _('Quantity'); ?></th>
								<th class="col-sm-4"></th>
								<th class="col-sm-1 text-right"></th>
							</tr>
						</thead>
						<tbody>
							@if(is_array($chit) && array_key_exists('chit', $chit) && !empty($chit['chit']))
							<tr class="empty" style="display:none">
							@else
							<tr class="empty">
							@endif
								<td colspan="5" align="center">
									<em><?php echo _('Browse items from left column and add here'); ?></em>
								</td>
							</tr>

							@if(is_array($chit) && array_key_exists('chit', $chit) && !empty($chit['chit']))
							@foreach($chit['chit'] as $key => $item)
							<tr class="{{$item['type'] == 'request'?'warning':'success'}}">
								<td>
									<span class="serial">{{++$ctr}}</span>
									<input type="hidden" class="id" name="chit[{{$key}}][id]" value="{{$item['id']}}" />
									<input type="hidden" class="category" name="chit[{{$key}}][category]" value="{{$item['category']}}" />
									<input type="hidden" class="type" name="chit[{{$key}}][type]" value="{{$item['type']}}" />
									<input type="hidden" name="chit[{{$key}}][name]" value="{{$item['name']}}" />
								</td>
								<td>{{$item['name']}}</td>
								<td>
									<div class="{{$errors->has('chit.'.$key.'.qty')?'has-error':''}}">
										<input class="input-sm form-control qty" id="{{$item['type']}}_{{$item['id']}}" type="number" name="chit[{{$key}}][qty]" value="{{$item['qty']}}" /></td>
									</div>
								<td>
									@if(isset($item['note']))
									<div class="{{$errors->has('chit.'.$key.'.note')?'has-error':''}}">
										<textarea name="chit[{{$key}}][note]" class="input-sm form-control note" rows="2" placeholder="<?php echo _('Note'); ?>">{{$item['note']}}</textarea>
									</div>
									@endif
								</td>
								<td class="text-right"><span onclick="return removeChitItem(this);" class="remove-item text-danger" title="Remove"><i class="fa fa-trash-o fa-2x"></i></span></td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				
					<hr> 
					<div class="col-sm-3">
						<p><span class="label label-success">&nbsp;</span> <span class="text-muted"><?php echo _('Indents');?></span></p>
					</div>
					<div class="col-sm-4">
						<p><span class="label label-warning">&nbsp;</span> <span class="text-muted"><?php echo _('Requirements');?></span></p>
					</div>
					<div class="col-sm-1">
						<span class="hidden saving-chit-form text-success"><i class="fa fa-spinner fa-spin"></i></span>
					</div>
					<div class="col-sm-4 text-right">
						<?php echo Form::button('<i class="fa fa-check"></i> ' . _('Submit Indent'), array('class'=>'submit-indent btn btn-primary disabled', 'type'=>'submit'));?>
					</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
var chitIndex = {{$chit_size}};//parseInt($('.chit-form table tbody tr').size());
var noOfRows = parseInt($('.chit-form table tbody tr').size());
$(function(){
	$('.product-list button.add, .product-list button.request').on('click', function(){
		var btn = $(this);
		var productRow = btn.closest('tr');
		var id = parseInt(productRow.find('.id').val());
		var category = parseInt(productRow.find('.category').val());
		var stock = parseInt(productRow.find('.stock').val());
		var reserved = parseInt(productRow.find('.reserved').val());
		var qty = productRow.find('.quantity').val() != ""?parseInt(productRow.find('.quantity').val()):0;
		var name = productRow.find('.name').val();
		var indented = ($("#indent_" + id).size())?$("#indent_" + id).val():0;
		var requested = ($("#request_" + id).size())?$("#request_" + id).val():0;

		if(stock == 0) {
			var row = '<tr class="warning">';
			row += '<td><span class="serial">'+noOfRows+'</span>';
			row += '<input type="hidden" class="id" name="chit['+chitIndex+'][id]" value="'+id+'" />';
			row += '<input type="hidden" class="category" name="chit['+chitIndex+'][category]" value="'+category+'" />';
			row += '<input type="hidden" class="type" name="chit['+chitIndex+'][type]" value="request" />';
			row += '<input type="hidden" name="chit['+chitIndex+'][name]" value="'+name+'" />';
			row += '</td>';
			row += '<td>'+name+'</td>';
			row += '<td><input class="input-sm form-control qty" type="number" id="request_'+id+'" name="chit['+chitIndex+'][qty]" value="'+qty+'" /></td>';
			row += '<td><textarea name="chit['+chitIndex+'][note]" class="note input-sm form-control" rows="2" placeholder="<?php echo _('Note'); ?>"></textarea></td>';
			row += '<td class="text-right"><span onclick="return removeChitItem(this);" class="remove-item text-danger" title="Remove"><i class="fa fa-trash-o fa-2x"></i></span></td>';
			row += "</tr>";
			
			addToChit(id, 'request', qty, row, btn);
		}
		else {
			var toIndent = parseInt(stock) - parseInt(indented);
			if(toIndent > 0) {
				if(qty <= toIndent)
					toIndent = qty;

				var indentRow = '<tr class="success">';
				indentRow += '<td><span class="serial">'+noOfRows+'</span>';
				indentRow += '<input type="hidden" class="id" name="chit['+chitIndex+'][id]" value="'+id+'" />';
				indentRow += '<input type="hidden" class="category" name="chit['+chitIndex+'][category]" value="'+category+'" />';
				indentRow += '<input type="hidden" class="type" name="chit['+chitIndex+'][type]" value="indent" />';
				indentRow += '<input type="hidden" name="chit['+chitIndex+'][name]" value="'+name+'" />';
				indentRow += '</td>';
				indentRow += '<td>'+name+'</td>';
				indentRow += '<td><input class="input-sm form-control qty" id="indent_'+id+'" type="number" name="chit['+chitIndex+'][qty]" value="'+toIndent+'" /></td>';
				indentRow += "<td></td>";
				indentRow += '<td class="text-right"><span onclick="return removeChitItem(this);" class="remove-item text-danger" title="Remove"><i class="fa fa-trash-o fa-2x"></i></span></td>';
				indentRow += "</tr>";

				addToChit(id, 'indent', toIndent, indentRow, btn);
			}

			var toRequest = parseInt(qty) - parseInt(toIndent);
			if(toRequest > 0) {
				var requestRow  = '<tr class="warning">';
				requestRow += '<td><span class="serial">'+noOfRows+'</span>';
				requestRow += '<input type="hidden" class="id" name="chit['+chitIndex+'][id]" value="'+id+'" />';
				requestRow += '<input type="hidden" class="category" name="chit['+chitIndex+'][category]" value="'+category+'" />';
				requestRow += '<input type="hidden" class="type" name="chit['+chitIndex+'][type]" value="request" />';
				requestRow += '<input type="hidden" name="chit['+chitIndex+'][name]" value="'+name+'" />';
				requestRow += '</td>';
				requestRow += '<td>'+name+'</td>';
				requestRow += '<td><input class="input-sm form-control qty" id="request_'+id+'" type="number" name="chit['+chitIndex+'][qty]" value="'+toRequest+'" /></td>';
				requestRow += '<td><textarea name="chit['+chitIndex+'][note]" class="input-sm form-control note" rows="2" placeholder="<?php echo _('Note'); ?>"></textarea></td>';
				requestRow += '<td class="text-right"><span onclick="return removeChitItem(this);" class="remove-item text-danger" title="Remove"><i class="fa fa-trash-o fa-2x"></i></span></td>';
				requestRow += "</tr>";
				
				addToChit(id, 'request', toRequest, requestRow, btn);
			}
		}

		productRow.find('.quantity').val('');
	});

	// Adjust product list height with the window size
	$('.product-list .table-wrapper').height(window.innerHeight - 250);

	$('.chit-form table tbody td input.qty').on('keyup', function(){
		if($(this).val() != "") {
			var chitRow = $(this).closest('tr');
			var id = chitRow.find('.id').val();
			var type = chitRow.find('.type').val();
			var stock = $("#product_" + id + " input.stock").val();
			
			if(type == 'indent') {
				if(parseInt($(this).val()) < parseInt(stock))
					saveChitForm('');
				else
					$(this).val(parseInt(stock));
			}
			else
				saveChitForm('');
		}
	});

	$('.chit-form table tbody td textarea.note').on('blur', function(){
		if($(this).val() != "")
			saveChitForm('');
	});

	if(parseInt($('.chit-form table tbody tr').size()) > 1)
		$(".submit-indent").removeClass('disabled');
});

function addToChit(id, rowType, qty, row, btn)
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
	
	if(insert) {
		$('.chit-form table tbody').append(row);
		noOfRows++;
		chitIndex++;
	}

	if($('.chit-form table tbody tr').size() > 1) {
		$('.chit-form table thead tr').removeClass('hidden');
		$('.chit-form table tbody tr.empty').hide();
		$(".submit-indent").removeClass('disabled');
	}

	$("#chit_size").val(chitIndex);

	saveChitForm(btn);

}

function removeChitItem(btn)
{
	var btn = $(btn);
	var chitRow = btn.closest('tr');
	var id = chitRow.find('.id').val();
	var type = chitRow.find('.type').val();
	var requestRow = [];

	// If item is indent, then look for request under item and remove as well
	if(type == 'indent')
		requestRow = $("#request_" + id).closest('tr');

	chitRow.animate({opacity:0}, 500, function(){
		chitRow.remove();

		reorderChitItem();
		saveChitForm($(btn));
	});

	// If we have request item
	if(requestRow.size() > 0) {
		requestRow.animate({opacity:0}, 400, function(){
			requestRow.remove();
			
			reorderChitItem();
			saveChitForm($(btn));
		});
	}
	
}

function reorderChitItem()
{
	$('.chit-form table tbody td .serial').each(function(key){
		$(this).text(++key);
	});

	if($('.chit-form table tbody tr').size() <= 1) {
		$('.chit-form table thead tr').addClass('hidden');
		$('.chit-form table tbody tr.empty').show();
	}
}

var activeSavingRequest = false;
function saveChitForm(btn)
{
	if(activeSavingRequest)
        return null;

	$.ajax({
		url: '{{route('indent.store')}}',
		method: 'post',
		dataType: 'jsonp',
		data: $(".chit-form form").serialize(),
		beforeSend: function(){
			$(".submit-indent").addClass('disabled');
			activeSavingRequest = true;
			// Button loader
			if(btn != '')
				btn.html('<i class="fa fa-spinner fa-spin"></i>');

			$('.chit-form .panel-heading span.saved').hide();
			$('.saving-chit-form').hide().removeClass('hidden').fadeIn(300);
			$('.chit-form .panel-heading span.saving').hide().removeClass('hidden').fadeIn(400);
		}
	}).done(function(result){
		// Button restore
		if(btn != '')
			btn.html('<i class="fa fa-shopping-cart"></i>');
		
		$('.saving-chit-form').fadeOut(400);
		$('.chit-form .panel-heading span.saving').fadeOut(300, function(){
			$('.chit-form .panel-heading span.saved').hide().removeClass('hidden').fadeIn(400).delay(600).fadeOut(400);
			
			if(parseInt($('.chit-form table tbody tr').size()) > 1)
				$(".submit-indent").removeClass('disabled');
		});
		activeSavingRequest = false;
	});
}

/* After adding more items to chit form, the scroll lock is not suitable, so we disable it*/
// window.onscroll = fixedChitForm;
// var scrollChitForm;
// function fixedChitForm()
// {
// 	if(window.pageYOffset >= 30) {
// 		$(".chit-form").stop(true, true).animate({
// 			top: (window.pageYOffset-30)
// 		},
// 		{
// 		    duration: 200,
// 		    specialEasing: {
// 		      	width: "linear",
// 		      	height: "easeOutBounce"
// 		    },
// 		    complete: function() {
// 	    		clearTimeout(scrollChitForm);
// 	    		if(window.pageYOffset < 2) {
// 			     	scrollChitForm = setTimeout(function(){
// 			      		$(".chit-form").animate({top:0}, 400);
// 			      	}, 300);
// 			    }
// 		    }
//   		});
// 	}
// }

</script>
@stop