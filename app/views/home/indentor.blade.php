@extends('layout.main')

@section('contentTop')

@stop

@section('content')
<div class="row mb20"><h2>Welcome Indentor</h2></div>
<div class="row dashboard-icons">
	<div class="col-md-6">
			<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
			<a type="button" class="btn btn-success btn-badge" >
				<i class="glyphicon glyphicon-align-left pull-left fa-4x"></i>
				<span class="text-right fa-4x counter pull-right">25</span>
				<div class="clearfix"></div>
				<span class="lead hidden-xs icon-title text-right">Indents</span>
			</a>
		</div>
		<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
			<a type="button" class="btn btn-primary btn-badge" >
				<i class="glyphicon glyphicon-list pull-left fa-4x"></i>
				<span class="text-right fa-4x counter pull-right">25</span>
				<div class="clearfix"></div>
				<span class="lead hidden-xs icon-title text-right">Pending</span>
			</a>
		</div>
		<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-warning btn-badge" >
			<i class="glyphicon glyphicon-warning-sign pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">25</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Approved</span>
		</a>
	</div>
	<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-danger btn-badge" >
			<i class="glyphicon glyphicon-sort-by-attributes-alt pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">25</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Out of Stock</span>
		</a>
	</div>
	</div>
	<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel panel-heading"><span class="glyphicon glyphicon-th"></span> Indent Status</div>
				<div class="panel panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<th class="col-md-1">No.</th>
							<th class="col-md-2">Category</th>
							<th class="col-md-3">Products</th>
							<th class="col-md-3">Indent Date</th>
							<th class="col-md-3">Quantity</th>
							<th>Status</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Gosa</td>
								<td>Furniture</td>
								<td>Chair</td>
								<td>2</td>
								<td>Pending</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Chhama</td>
								<td>Stationary</td>
								<td>Pen</td>
								<td>5</td>
								<td>Pending</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Chhama</td>
								<td>Stationary</td>
								<td>Ink</td>
								<td>10</td>
								<td>Pending</td>
							</tr>
							<tr class="warning">
								<td>4</td>
								<td>Chhama</td>
								<td>Furniture</td>
								<td>Table</td>
								<td>1</td>
								<td>Pending</td>
							</tr>
							<tr>
								<td>5</td>
								<td>Chhama</td>
								<td>Furniture</td>
								<td>Table</td>
								<td>2</td>
								<td>Pending</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</div>


	
@stop

