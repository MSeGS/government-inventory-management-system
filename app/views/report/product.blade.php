@extends('layout.main')
@section('contentTop')
<div class="row mb20">
	<div class="col-md-12 ">
		<h1><?php echo _("Product Reports");?></h1>
	</div>
<?php /*
	<ul class="nav nav-tabs">
		<li class="active"><a href="{{route('report.product')}}">Tabular Report</a>	</li>
		<!-- <li class="active"><a href="{{route('report.product-graphic')}}">Graphical Report</a></li> -->
		<li><a href="{{route('report.product-detail')}}">Detailed Report</a></li>
	</ul>
*/ ?>
</div>
<div class="row">
	<div class="col-md-12 ">
		{{Form::open(array('url'=>route('report.product'), 'method'=>'get'))}}
			<div class="form-group col-md-3">
				<div class="row">
					{{Form::select('month', $months, $filter['month'], array('class' => 'dropdown input-sm', 'id' => 'month'))}}
				</div>
			</div>
			<div class="form-group col-md-3">
				{{Form::select('year', $years, $filter['year'], array('class' => 'dropdown input-sm', 'id' => 'filter_year'))}}
			</div>
			<div class="form-group col-md-1">
				{{Form::submit('Search', array('class' => 'btn btn-sm btn-default'))}}
			</div>
		{{Form::close()}}
		@if($filter['month']&&$filter['year']!=null)
		<div class="form-group col-md-5 text-right">
			<div class="row">
				<a href="{{URL::route('report.product')}}" type="button" class="btn btn-sm btn-default">View All</a>
			</div>
		</div>
		@endif
	</div>
</div>
@stop
@section('content')

<div class="row">
	<div class="col-md-12 ">
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
					@foreach($products as $key=>$product)
					<tr>
						<td>{{$index + $key}}</td>
						<td><a href="{{route('report.product-detail',array('id'=>$product->id))}}" >{{$product->name}}</a></td>
						<td>{{get_product_stock($product->id, $filter['year'], $filter['month'])}} </td>
						<td>{{Report::requirement($product->id, $filter['year'], $filter['month'])}}</td>
						<td>{{sizeof(Report::indented($product->id))}}</td>
						<td>{{Report::dispatched($product->id, $filter['year'], $filter['month'])}}</td>
						<td>{{Report::damaged($product->id, $filter['year'], $filter['month'])}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$products->appends(array('year'=>$filter['year'],'month'=>$filter['month']))->links()}}
	</div>
</div>
@stop
