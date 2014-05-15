@extends('layout.main')

@section('contentTop')
<div class="text-right">
	<a href="{{$current_user->hasAccess('indent.index')?route('indent.index'):route('indent.mine')}}" class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i> <?php echo _('Back To List'); ?></a>
</div>
@stop

@section('content')
<div class="edit-indent-page">
	@if(Session::has('message'))
	<div class="alert alert-success">
		{{Session::get('message')}}	
	</div>
	@endif

	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="text-center"><?php echo _('Process Indent'); ?></h5>
		</div>
		<div class="panel-body">
			
			<table class="table table-striped">
				<tbody>
					<tr>
						<th class="text-right"><?php echo _('Indentor Name:'); ?></th>
						<td>
							{{$indent->indentor->full_name}}<br>
							<span class="text-muted">{{$indent->indentor->designation}}</span>
						</td>
						<th class="text-right"><?php echo _('Department:'); ?></th>
						<td>{{isset($indent->indentor->department->name)?$indent->indentor->department->name:'-'}}</td>
						<th class="text-right"><?php echo _('Contact:'); ?></th>
						<td>
							{{$indent->indentor->email_id}}<br>
							{{$indent->indentor->phone_no}}
						</td>
					</tr>
					<tr>
						<th class="text-right"><?php echo _('Reference No:'); ?></th>
						<td>{{$indent->reference_no}}</td>
						<th class="text-right"><?php echo _('Indent Date:'); ?></th>
						<td>{{date('j', strtotime($indent->indent_date)) . '<sup>' . date('S', strtotime($indent->indent_date)) . '</sup> ' . date('F Y, h:iA', strtotime($indent->indent_date))}}</td>
						<th class="text-right"><?php echo _('Indent Status:'); ?></th>
						<td>
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
						</td>
					</tr>
				</tbody>
			</table>

			{{Form::open(array('url'=>route('indent.postProcess', $indent->id), 'method'=>'post', 'class'=>'form-vertical'))}}

				@if($indent->items->count())
				<h5><i class="fa fa-bars"></i> <?php echo _('Indents'); ?></h5>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th class="col-sm-3"><?php echo _('Name'); ?></th>
							<th class="col-sm-2"><?php echo _('Stock / Reserved'); ?></th>
							<th class="col-sm-2"><?php echo _('Quantity'); ?></th>
							<th class="col-sm-3"><?php echo _('Reason'); ?></th>
							<th class="col-sm-2"></th>
						</tr>
					</thead>
					<tbody>
					@foreach($indent->items as $key => $item)
					<tr>
						<?php $stock = get_product_stock($item->product->id); ?>
						<td>{{++$key}}</td>
						<td>{{$item->product->name}}</td>
						<td>{{$stock}} / <span>{{$item->product->reserved_amount}}</span></td>
						<td>
							<span class="{{$errors->has('indent.'.$item->product->id.'.qty')?'has-error':''}}"><input min="0" class="input-sm form-control qty" id="indent_{{$item->product->id}}" type="number" name="indent[{{$item->product->id}}][qty]" value="{{Input::old('indent.'.$item->product->id.'.qty', $item->quantity)}}" /></span>
						</td>
						<td>
							@if(strlen(trim($item->indent_reason)))
							<p><strong><?php echo _('Indent Reason'); ?></strong><br>{{$item->indent_reason}}</p>
							@endif

							<p class="reject-reason {{Input::old('indent.'.$item->product->id.'.status', $item->status)!='rejected'?'hidden':''}} {{$errors->has('indent.'.$item->product->id.'.reject_reason')?'has-error':''}}">
								<strong class="text-danger"><?php echo _('Reject Reason'); ?></strong><br>
							<textarea name="indent[{{$item->product->id}}][reject_reason]" class="input-sm form-control note" rows="4" placeholder="<?php echo _('Provide reason if rejected'); ?>">{{Input::old('indent.'.$item->product->id.'.reject_reason', $item->reject_reason)}}</textarea>
							</p>
						</td>
						<td class="text-right actions">
							<label class="text-primary">{{Form::radio('indent['.$item->product->id.'][status]', 'approved', ((Input::old('indent.'.$item->product->id.'.status', $item->status)=='approved' || $item->status='pending')?true:false) )}} Approve</label> 
							<label class="text-danger">{{Form::radio('indent['.$item->product->id.'][status]', 'rejected', ((Input::old('indent.'.$item->product->id.'.status', $item->status)=='rejected')?true:false))}} Reject</label>
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
							<th class="col-sm-3"><?php echo _('Name'); ?></th>
							<th class="col-sm-2"><?php echo _('Stock / Reserved'); ?></th>
							<th class="col-sm-2"><?php echo _('Quantity'); ?></th>
							<th class="col-sm-3"><?php echo _('Reason'); ?></th>
							<th class="col-sm-2"></th>
						</tr>
					</thead>
					<tbody>
					@foreach($indent->requirements as $key => $item)
					<tr>
						<td>{{++$key}}</td>
						<td>{{$item->product->name}}</td>
						<td>{{get_product_stock($item->product->id)}} / <span>{{$item->product->reserved_amount}}</span></td>
						<td>
							<span class="{{$errors->has('requirement.'.$item->product->id.'.qty')?'has-error':''}}"><input min="0" class="input-sm form-control qty" id="requirement_{{$item->product->id}}" type="number" name="requirement[{{$item->product->id}}][qty]" value="{{Input::old('requirement.'.$item->product->id.'.qty', $item->quantity)}}" /></span>
						</td>
						<td>
							<p class="reject-reason {{Input::old('requirement.'.$item->product->id.'.status', $item->status)!='rejected'?'hidden':''}} {{$errors->has('requirement.'.$item->product->id.'.reason')?'has-error':''}}">
								<strong class="text-danger"><?php echo _('Reject Reason'); ?></strong><br>
								<textarea name="requirement[{{$item->product->id}}][reason]" class="input-sm form-control note" rows="4" placeholder="<?php echo _('Provide reason if rejected'); ?>">{{Input::old('requirement.'.$item->product->id.'.reason', $item->reason)}}</textarea>
							</p>
						</td>
						<td class="text-right actions">
							<label class="text-primary">{{Form::radio('requirement['.$item->product->id.'][status]', 'approved', ((Input::old('requirement.'.$item->product->id.'.status', $item->status)=='approved' || $item->status == 'pending')?true:false))}} Approve</label>
							<label class="text-danger">{{Form::radio('requirement['.$item->product->id.'][status]', 'rejected', ((Input::old('requirement.'.$item->product->id.'.status', $item->status)=='rejected')?true:false))}} Reject</label>
						</td>
					</tr>
					@endforeach
					</tbody>
				</table>
				@endif

				<div class="text-right">
					<?php echo Form::button('<i class="fa fa-times"></i> ' . _('Reject'), array('class'=>'submit-indent btn btn-danger', 'type'=>'submit', 'name'=>'process', 'value'=>'rejected'));?>
					<?php echo Form::button('<i class="fa fa-check"></i> ' . _('Approve'), array('class'=>'submit-indent btn btn-primary', 'type'=>'submit', 'name'=>'process', 'value'=>'approved'));?>
					<?php //echo Form::button('<i class="fa fa-save"></i> ' . _('Save'), array('class'=>'submit-indent btn btn-success', 'type'=>'submit', 'value'=>'save'));?>
				</div>
			{{Form::close()}}
		</div>
	</div>

</div>
@stop

@section('scripts')
<script type="text/javascript">
$(function(){
	$(".actions input").on('click', function(){
		var productRow = $(this).closest('tr');
		console.log($(this).val());
		if($(this).is(':checked') && $(this).val()=='rejected') {
			productRow.find('.reject-reason').removeClass('hidden');
		} else {
			productRow.find('.reject-reason').addClass('hidden');
		}
	});
});
</script>
@stop