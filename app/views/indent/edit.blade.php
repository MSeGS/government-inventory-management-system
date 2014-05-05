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
				<h5 class="text-center"><?php echo _('Indent Chit Form'); ?></h5>
			</div>
			<div class="panel-body">
				
				<table class="table table-striped">
					<tbody>
						<tr>
							<th class="text-right"><?php echo _('Reference No:'); ?></th>
							<td>{{$indent->reference_no}}</td>
							<th class="text-right"><?php echo _('Status:'); ?></th>
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
							<th class="text-right"><?php echo _('Indent Date:'); ?></th>
							<td>{{$indent->reference_no}}</td>
						</tr>
					</tbody>
				</table>

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
							<?php $stock = get_product_stock($item->product->id); ?>
							<td>{{++$key}}</td>
							<td>{{$item->product->name}}</td>
							<td>{{$stock}} / <span>{{$item->product->reserved_amount}}</span></td>
							<td>
								@if($item->status == 'approved')
								{{$item->quantity}}
								@else
								<span class="{{$errors->has('indent.'.$item->product->id.'.qty')?'has-error':''}}"><input min="0" class="input-sm form-control qty" id="indent_{{$item->product->id}}" type="number" name="indent[{{$item->product->id}}][qty]" value="{{Input::old('indent.'.$item->product->id.'.qty', $item->quantity)}}" /></span>
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
								<p class="{{$errors->has('indent.'.$item->product->id.'.note')?'has-error':''}}"><strong><?php echo _('Indent Reason'); ?></strong><br>
								<textarea name="indent[{{$item->product->id}}][note]" class="input-sm form-control note" rows="4" placeholder="<?php echo _('Reason'); ?>">{{Input::old('indent.'.$item->product->id.'.note', $item->indent_reason)}}</textarea>
								</p>
								@endif

								@if($item->status == 'rejected' && strlen(trim($item->reject_reason)))
								<p><strong class="text-danger"><?php echo _('Reject Reason'); ?></strong><br>{{$item->reject_reason}}</p>
								@endif
							</td>
							<td class="text-right">
								@if(in_array($item->status, array('rejected', 'pending')))
								<label class="text-danger">{{Form::checkbox('indent['.$item->product->id.'][remove]', Input::old('indent.'.$item->product->id.'.remove', 1))}} Delete</label>
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
								<span class="{{$errors->has('requirement.'.$item->product->id.'.qty')?'has-error':''}}"><input min="0" class="input-sm form-control qty" id="requirement_{{$item->product->id}}" type="number" name="requirement[{{$item->product->id}}][qty]" value="{{Input::old('requirement.'.$item->product->id.'.qty', $item->quantity)}}" /></span>
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
								<label class="text-danger">{{Form::checkbox('requirement['.$item->product->id.'][remove]', Input::old('requirement.'.$item->product->id.'.remove', 1))}} Delete</label>
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
</script>
@stop