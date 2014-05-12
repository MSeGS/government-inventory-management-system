@extends('layout.main')
@section('content')
<div class="row">
	<div class="col-md-12">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th class="col-md-3"><?php echo _("Store") ?></th>
						<th class="col-md-1"><?php echo _("Products") ?></th>
						<th class="col-md-1"><?php echo _("Indents") ?></th>
						<th class="col-md-1"><?php echo _("Requirements") ?></th>
						<th class="col-md-2"><?php echo _("Administrator") ?></th>
						<th class="col-md-2"><?php echo _("Storekeeper") ?></th>
						<th class="col-md-2"><?php echo _("Indentor") ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; ?>
					@foreach($stores as $store)
					<?php $report = Report::store($store->id); ?>
					<tr>
						<td>{{++$i}}</td>
						<td>
							{{$store->department->name}}<br>
							<strong><small><?php echo _('STORE CODE:'); ?>  {{$store->store_code}}</small></strong>
						</td>
						<td>{{$report['product']}}</td>
						<td>{{$report['indent']}}</td>
						<td>{{$report['requirement']}}</td>
						<td>{{$report['administrator']}}</td>
						<td>{{$report['store_keeper']}}</td>
						<td>{{$report['indentor']}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
	</div>
</div>
@stop
