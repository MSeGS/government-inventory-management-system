@extends('layout.main')

@section('contentTop')
<div class="text-right">
	<a href="{{$current_user->hasAccess('indent.index')?route('indent.index'):route('indent.mine')}}" class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i> <?php echo _('Back To List'); ?></a>
	@if($current_user->hasAccess('indent.edit') && in_array($indent->status, array("pending_approval", "rejected")))
	<a href="{{route('indent.edit', $indent->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> <?php echo _('Edit'); ?></a>
	@endif

	@if($current_user->hasAccess('indent.process') && in_array($indent->status, array("pending_approval", "rejected")))
	<a href="{{route('indent.process', $indent->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-cog"></i> <?php echo _('Process'); ?></a>
	@endif

	@if($current_user->hasAccess('indent.dispatch') && in_array($indent->status, array("approved")))
	<a href="{{route('indent.dispatch', $indent->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-truck"></i> <?php echo _('Dispatch'); ?></a>
	@endif
</div>
@stop

@section('content')
<div class="create-indent-page">

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
								<span class="text-primary">
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

				@if($indent->items->count())
				<h5><i class="fa fa-bars"></i> <?php echo _('Indents'); ?></h5>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th class="col-sm-3"><?php echo _('Name'); ?></th>
							<th class="col-sm-1"><?php echo _('Quantity'); ?></th>
							<th class="col-sm-1"><?php echo _('Supplied'); ?></th>
							<th class="col-sm-1"><?php echo _('Status'); ?></th>
							<th class="col-sm-5"><?php echo _('Reason'); ?></th>
						</tr>
					</thead>
					<tbody>
					@foreach($indent->items as $key => $item)
					<tr>
						<td>{{++$key}}</td>
						<td>{{$item->product->name}}</td>
						<td>{{$item->quantity}}</td>
						<td>{{$item->supplied}}</td>
						<td>
							@if($item->status == 'pending')
							<span class="text-warning">
							@elseif($item->status == 'approved')
							<span class="text-primary">
							@elseif($item->status == 'rejected')
							<span class="text-danger">
							@endif
							<strong>{{ucwords($item->status)}}</strong>
							</span>
						</td>
						<td>
							@if(strlen(trim($item->indent_reason)))
							<p><strong><?php echo _('Indent Reason'); ?></strong><br>
							{{$item->indent_reason}}</p>
							@endif

							@if($item->status == 'rejected' && strlen(trim($item->reject_reason)))
							<p><strong class="text-danger"><?php echo _('Reject Reason'); ?></strong><br>
							{{$item->reject_reason}}</p>
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
							<th class="col-sm-5"><?php echo _('Name'); ?></th>
							<th class="col-sm-3"><?php echo _('Quantity'); ?></th>
							<th class="col-sm-3"><?php echo _('Status'); ?></th>
						</tr>
					</thead>
					<tbody>
					@foreach($indent->requirements as $key => $item)
					<tr>
						<td>{{++$key}}</td>
						<td>{{$item->product->name}}</td>
						<td>{{$item->quantity}}</td>
						<td>
							@if($item->status == 'approved')
							<span class="text-primary">
							@elseif($item->status == 'pending')
							<span class="text-warning">
							@elseif($item->status == 'procured')
							<span class="text-success">
							@elseif($item->status == 'rejected')
							<span class="text-danger">
							@endif
							<strong>{{ucwords($item->status)}}</strong>
							</span>
						</td>
					</tr>
					@endforeach
					</tbody>
				</table>
				@endif

			</div>
		</div>

</div>
@stop