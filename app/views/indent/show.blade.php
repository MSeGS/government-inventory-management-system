@extends('layout.main')

@section('contentTop')
<div class="text-right">
	<a href="{{$current_user->hasAccess('indent.index')?route('indent.index'):route('indent.mine')}}" class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i> <?php echo _('Back To List'); ?></a>
	<a href="{{route('indent.edit', $indent->id)}}" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> <?php echo _('Edit'); ?></a>
</div>
@stop

@section('content')
<div class="create-indent-page">

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
							@if($item->status == 'approved')
							<span class="text-success">
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
					</tr>
					@endforeach
					</tbody>
				</table>
				@endif

			</div>
		</div>

</div>
@stop