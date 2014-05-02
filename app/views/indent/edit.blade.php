@extends('layout.main')

@section('contentTop')
<div class="text-right">
	<a href="{{$current_user->hasAccess('indent.index')?route('indent.index'):route('indent.mine')}}" class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i> <?php echo _('Back To List'); ?></a>
</div>
@stop

@section('content')
<div class="edit-indent-page">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h5 class="text-center"><?php echo _('Indent Chit Form'); ?></h5>
				<div class="row">
					<div class="col-sm-6 text-left"><span class="text-muted">Indent Date - {{date('dS F Y, h:iA', strtotime($indent->indent_date))}}</span></div>
					<div class="col-sm-6 text-right">
						Status - 
						@if($indent->status == "pending_approval")
						<span class="text-warning">
						@elseif($indent->status == "rejected")
						<span class="text-danger">
						@elseif($indent->status == "approved")
						<span class="text-info">
						@elseif($indent->status == "dispatched")
						<span class="text-success">
						@elseif($indent->status == "partial_dispatched")
						<span class="text-success">
						@endif
							<strong>{{ucwords(str_replace('_',' ',$indent->status))}}</strong>
						</span>
					</div>
				</div>
				
			</div>
			<div class="panel-body">
				
				{{Form::open(array('url'=>route('indent.update', $indent->id), 'method'=>'put', 'class'=>'form-vertical'))}}

					@if($indent->items->count())
					<h5><i class="fa fa-bars"></i> <?php echo _('Indents'); ?></h5>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th class="col-sm-3"><?php echo _('Name'); ?></th>
								<th class="col-sm-2"><?php echo _('Stock / Reserved'); ?></th>
								<th class="col-sm-1"><?php echo _('Quantity'); ?></th>
								<th class="col-sm-1"><?php echo _('Status'); ?></th>
								<th class="col-sm-4"><?php echo _('Reason'); ?></th>
								<th class="col-sm-1"></th>
							</tr>
						</thead>
						<tbody>
						@foreach($indent->items as $key => $item)
						<tr>
							<td>{{++$key}}</td>
							<td>{{$item->product->name}}</td>
							<td>{{get_product_stock($item->product->id)}} / <span>{{$item->product->reserved_amount}}</span></td>
							<td>
								@if($item->status == 'approved')
								{{$item->quantity}}
								@else
								<input min="0" class="input-sm form-control qty" id="indent_{{$indent->id}}" type="number" name="indent[{{$key}}][qty]" value="{{$item->quantity}}" />
								@endif
							</td>
							<td>
								@if($item->status == 'pending')
								<span class="text-warning">
								@elseif($item->status == 'approved')
								<span class="text-success">
								@elseif($item->status == 'rejected')
								<span class="text-danger">
								@endif
								<strong>{{ucwords($item->status)}}</strong>
								</span>
							</td>
							<td>
								@if($item->status == 'approved')
								@if(strlen(trim($item->indent_reason)))
								<p><strong><?php echo _('Indent Reason'); ?></strong><br>{{$item->indent_reason}}</p>
								@endif
								@else
								<p><strong><?php echo _('Indent Reason'); ?></strong><br>
								<textarea name="indent[{{$key}}][note]" class="input-sm form-control note" rows="4" placeholder="<?php echo _('Reason'); ?>">{{$item->indent_reason}}</textarea>
								</p>
								@endif

								@if($item->status == 'rejected' && strlen(trim($item->reject_reason)))
								<p><strong class="text-danger"><?php echo _('Reject Reason'); ?></strong><br>{{$item->reject_reason}}</p>
								@endif
							</td>
							<td class="text-right">
								@if(in_array($item->status, array('rejected', 'pending')))
								<a href="javascript:void(0);" onclick="return removeChitItem(this);" class="remove-item text-danger" title="Remove"><i class="fa fa-trash-o fa-2x"></i></a>
								@endif
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
					@endif

					@if($indent->requirements->count())
					<h5><i class="fa fa-bars"></i> <?php echo _('Requirements'); ?></h5>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th class="col-sm-4"><?php echo _('Name'); ?></th>
								<th class="col-sm-2"><?php echo _('Quantity'); ?></th>
								<th class="col-sm-2"><?php echo _('Stock / Reserved'); ?></th>
								<th class="col-sm-2"><?php echo _('Status'); ?></th>
								<th class="col-sm-1"></th>
							</tr>
						</thead>
						<tbody>
						@foreach($indent->requirements as $key => $item)
						<tr>
							<td>{{++$key}}</td>
							<td>{{$item->product->name}}</td>
							<td>{{get_product_stock($item->product->id)}} / <span>{{$item->product->reserved_amount}}</span></td>
							<td>
								@if($item->status == 'procured')
								{{$item->quantity}}
								@else
								<input min="0" class="input-sm form-control qty" id="requirement_{{$indent->id}}" type="number" name="requirement[{{$key}}][qty]" value="{{$item->quantity}}" />
								@endif
							</td>
							<td>
								@if($item->status == 'pending')
								<span class="text-warning">
								@elseif($item->status == 'procured')
								<span class="text-success">
								@elseif($item->status == 'rejected')
								<span class="text-danger">
								@endif
								<strong>{{ucwords($item->status)}}</strong>
								</span>
							</td>
							<td class="text-right">
								@if(in_array($item->status, array('rejected', 'pending')))
								<a href="javascript:void(0);" onclick="return removeChitItem(this);" class="remove-item text-danger" title="Remove"><i class="fa fa-trash-o fa-2x"></i></a>
								@endif
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
					@endif

					<div class="text-right">
						<?php echo Form::button('<i class="fa fa-save"></i> ' . _('Save'), array('class'=>'submit-indent btn btn-success', 'type'=>'submit'));?>
					</div>
				{{Form::close()}}
			</div>
		</div>

</div>
@stop

@section('scripts')
<script type="text/javascript">
$(function(){

});

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
	noOfRowsIndent = parseInt($('.chit-form table#indent_items tbody tr').size());
	noOfRowsRequirement = parseInt($('.chit-form table#requirement_items tbody tr').size());

	$('.chit-form table#indent_items tbody td .serial').each(function(key){
		$(this).text(++key);
	});

	$('.chit-form table#requirement_items tbody td .serial').each(function(key){
		$(this).text(++key);
	});

	if($('.chit-form table#indent_items tbody tr').size() <= 1) {
		$('.chit-form table#indent_items thead tr').addClass('hidden');
		$('.chit-form table#indent_items tbody tr.empty').show();
	}

	if($('.chit-form table#requirement_items tbody tr').size() <= 1) {
		$('.chit-form table#requirement_items thead tr').addClass('hidden');
		$('.chit-form table#requirement_items tbody tr.empty').show();
	}
}
</script>
@stop