@extends('layout.main')

@section('contentTop')
<div class="row"><h2>Welcome {{$current_user->full_name}}</h2></div>
@stop

@section('content')
<div class="row dashboard-icons">
	<div class="col-md-6">
		<div class="row">
			<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
				<a type="button" class="btn btn-success btn-badge" href="{{route('indent.index',array('status'=>'pending_approval'))}}" >
					<i class="glyphicon glyphicon-align-left pull-left fa-4x"></i>
					<span class="text-right fa-4x counter pull-right">{{$pendingIndents}}</span>
					<div class="clearfix"></div>
					<span class="lead hidden-xs icon-title text-right"><?php echo _('New Indents'); ?></span>
				</a>
			</div>
			<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
				<a type="button" class="btn btn-primary btn-badge" >
					<i class="glyphicon glyphicon-list pull-left fa-4x"></i>
					<span class="text-right fa-4x counter pull-right">{{$pendingRequirements}}</span>
					<div class="clearfix"></div>
					<span class="lead hidden-xs icon-title text-right"><?php echo _('Requirements'); ?></span>
				</a>
			</div>
			<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
				<a type="button" class="btn btn-warning btn-badge" href="{{route('damage.index',array('status'=>'pending'))}}">
					<i class="glyphicon glyphicon-warning-sign pull-left fa-4x"></i>
					<span class="text-right fa-4x counter pull-right">{{$pendingDamages}}</span>
					<div class="clearfix"></div>
					<span class="lead hidden-xs icon-title text-right"><?php echo _('Pending Damage Report'); ?></span>
				</a>
			</div>
			<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
				<a type="button" class="btn btn-danger btn-badge" href="{{route('damage.index',array('in_stock'=>'0'))}}">
					<i class="glyphicon glyphicon-sort-by-attributes-alt pull-left fa-4x"></i>
					<span class="text-right fa-4x counter pull-right">{{$outOfStock}}</span>
					<div class="clearfix"></div>
					<span class="lead hidden-xs icon-title text-right"><?php echo _('Out of Stock'); ?></span>
				</a>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading"><span class="glyphicon glyphicon-th"></span> Latest Indents</div>
			<div class="panel-body">
				<table class="table table-striped ">
					<thead>
						<th class="col-md-1">No.</th>
						<th class="col-md-4">Indentor</th>
						<th class="col-md-3">Category</th>
						<th class="col-md-3">Products</th>
						<th>Quantity</th>
					</thead>
					<tbody>
						@if($latestIndents->count() > 0)
						@foreach($latestIndents as $indent)
						@foreach($indent->items as $key=>$item)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$indent->indentor->full_name}}</td>
							<td>{{$item->product->category->category_name}}</td>
							<td>{{$item->product->name}}</td>
							<td>{{$item->quantity}}</td>
						</tr>
						@endforeach
						@endforeach
						@else
						<tr class="warning">
							<td class="text-center" colspan="5"><?php echo _('Indents not found'); ?></td>
						</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-warning">
				<div class="panel-heading"><span class="glyphicon glyphicon-th"></span> <?php echo _('Top Damaged Products'); ?></div>
				<div class="panel-body">
					<table class="table table-striped ">
						<thead>
							<th class="col-md-1"><?php echo _('No.'); ?></th>
							<th class="col-md-4"><?php echo _('Category'); ?></th>
							<th class="col-md-4"><?php echo _('Product'); ?></th>
							<th><?php echo _('Quantity'); ?></th>
						</thead>
						
						<tbody>
							@if($damagedProducts->count() > 0)
							@foreach($damagedProducts as $key=>$damage)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$damage->product->category->category_name}}</td>
								<td>{{$damage->product->name}}</td>
								<td>{{$damage->sum_qty}}</td>
							</tr>
							@endforeach
							@else
							<tr class="warning">
								<td class="text-center" colspan="4">
								<?php echo _('No products damaged yet. :D'); ?>
								</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>	
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-warning">
				<div class="panel-heading"><span class="glyphicon glyphicon-th"></span> <?php echo _('Less Stock Products'); ?></div>
				<div class="panel-body">
					<table class="table table-striped ">
						<thead>
							<th class="col-md-1"><?php echo _('No.'); ?></th>
							<th class="col-md-4"><?php echo _('Category'); ?></th>
							<th class="col-md-4"><?php echo _('Product'); ?></th>
							<th><?php echo _('Quantity'); ?></th>
						</thead>
						
						<tbody>
							@if($lessStockProducts->count() > 0)
							@foreach($lessStockProducts as $key=>$product)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$product->category->category_name}}</td>
								<td>{{$product->name}}</td>
								<td>{{$product->in_stock}}</td>
							</tr>
							@endforeach
							@else
							<tr class="warning">
								<td class="text-center" colspan="4">
								<?php echo _('No products less than reserved'); ?>
								</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>	
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-danger">
				<div class="panel-heading"><span class="glyphicon glyphicon-th"></span> Out of Stocks</div>
				<div class="panel panel-body">
					<table class="table table-striped ">
						<thead>
							<tr>
								<th class="col-md-1">No.</th>
								<th class="col-md-5">Category</th>
								<th class="col-md-5">Product</th>
							</tr>
						</thead>
						<tbody>
							@if($lessStockProducts->count() > 0)
							@foreach($lessStockProducts as $key=>$product)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$product->category->category_name}}</td>
								<td>{{$product->name}}</td>
							</tr>
							@endforeach
							@else
							<tr class="warning">
								<td class="text-center" colspan="3">
								<?php echo _('No products out of stock'); ?>
								</td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

