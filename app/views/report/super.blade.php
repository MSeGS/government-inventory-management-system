@extends('layout.main')
@section('content')
<div class="row">
	<div class="col-md-12">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-md-1">#</th>
						<th class="col-md-2"><?php echo _("Store") ?></th>
						<th class="col-md-1"><?php echo _("Store Code") ?></th>
						<th class="col-md-1"><?php echo _("Total Indent") ?></th>
						<th class="col-md-1"><?php echo _("Total Product") ?></th>
						<th class="col-md-2"><?php echo _("Indentor") ?></th>
						<th class="col-md-2"><?php echo _("Administrator") ?></th>
						<th class="col-md-2"><?php echo _("Store Keeper") ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; ?>
					@foreach($stores as $store)
					<tr>
						<td>{{++$i}}</td>
						<td>{{$store->department->name}}</td>
						<td>{{$store->store_code}}</td>
						<td>{{sizeof($store->indents)}}</td>
						<td>{{sizeof($store->product)}}</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					@endforeach
				</tbody>
			</table>
	</div>
</div>
@stop
