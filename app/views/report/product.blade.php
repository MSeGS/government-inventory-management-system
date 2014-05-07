@extends('layout.main')
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-md-1">#</th>
						<th class="col-md-3"><?php echo _("Name") ?></th>
						<th class="col-md-2"><?php echo _("In Stock") ?></th>
						<th class="col-md-2"><?php echo _("Requirement") ?></th>
						<th class="col-md-1"><?php echo _("Indents") ?></th>
						<th class="col-md-2"><?php echo _("Dispatched") ?></th>
						<th><?php echo _("Damage") ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; ?>
					@foreach($products as $product)
					<tr>
						<td>{{++$i}}</td>
						<td>{{$product->name}}</td>
						<td>{{get_product_stock($product->id)}} </td>
						<td>{{Report::requirement($product->id)}}</td>
						<td>{{get_product_supplied($product->id)}}</td>
						<td>{{Report::dispatched($product->id)}}</td>
						<td>{{Report::damaged($product->id)}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
	</div>
</div>
@stop
