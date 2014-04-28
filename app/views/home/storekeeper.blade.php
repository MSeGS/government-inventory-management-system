@extends('layout.main')

@section('contentTop')

@stop

@section('content')
<div class="row mb20"><h2>Welcome Storekeeper</h2></div>
<div class="row dashboard-icons">
	<div class="col-md-6">
			<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
			<a type="button" class="btn btn-success btn-badge" >
				<i class="glyphicon glyphicon-align-left pull-left fa-4x"></i>
				<span class="text-right fa-4x counter pull-right">25</span>
				<div class="clearfix"></div>
				<span class="lead hidden-xs icon-title text-right">New Indents</span>
			</a>
		</div>
		<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
			<a type="button" class="btn btn-primary btn-badge" >
				<i class="glyphicon glyphicon-list pull-left fa-4x"></i>
				<span class="text-right fa-4x counter pull-right">25</span>
				<div class="clearfix"></div>
				<span class="lead hidden-xs icon-title text-right">Requirements</span>
			</a>
		</div>
		<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-warning btn-badge" >
			<i class="glyphicon glyphicon-warning-sign pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">25</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Damages</span>
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
			<div class="panel panel-primary">
				<div class="panel panel-heading"><span class="glyphicon glyphicon-th"></span> Latest Indents</div>
				<div class="panel panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<th class="col-md-1">No.</th>
							<th class="col-md-4">Indentor</th>
							<th class="col-md-3">Category</th>
							<th class="col-md-3">Products</th>
							<th>Quantity</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Gosa</td>
								<td>Furniture</td>
								<td>Chair</td>
								<td>2</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Chhama</td>
								<td>Stationary</td>
								<td>Pen</td>
								<td>5</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Chhama</td>
								<td>Stationary</td>
								<td>Ink</td>
								<td>10</td>
							</tr>
							<tr class="warning">
								<td>4</td>
								<td>Chhama</td>
								<td>Furniture</td>
								<td>Table</td>
								<td>1</td>
							</tr>
							<tr>
								<td>5</td>
								<td>Chhama</td>
								<td>Furniture</td>
								<td>Table</td>
								<td>2</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</div>


	<div class="row">
		<div class="col-md-5">

		</div>
		<div class="col-md-4">
			<div class="panel panel-danger">
				<div class="panel panel-heading"><span class="glyphicon glyphicon-th"></span> Less Stock Products</div>
				<div class="panel panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<th class="col-md-1">No.</th>
							<th class="col-md-4">Category</th>
							<th class="col-md-4">Product</th>
							<th>Quantity</th>
						</thead>
						
						<tbody>
							<tr>
								<td>1</td>
								<td>Stationary</td>
								<td>Paper Rims</td>
								<td>4</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Stationary</td>
								<td>Paper Rims</td>
								<td>4</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Stationary</td>
								<td>Paper Rims</td>
								<td>4</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Stationary</td>
								<td>Paper Rims</td>
								<td>4</td>
							</tr>
							<tr>
								<td>5</td>
								<td>Stationary</td>
								<td>Paper Rims</td>
								<td>4</td>
							</tr>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-success">
				<div class="panel-heading"><span class="glyphicon glyphicon-th"></span> Out of Stocks</div></div>
				<div class="panel panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th class="col-md-1">No.</th>
								<th class="col-md-5">Category</th>
								<th class="col-md-5">Product</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Furniture</td>
								<td>Table</td>
							</tr><tr>
								<td>2</td>
								<td>Furniture</td>
								<td>Table</td>
							</tr><tr>
								<td>3</td>
								<td>Furniture</td>
								<td>Table</td>
							</tr><tr>
								<td>4</td>
								<td>Furniture</td>
								<td>Table</td>
							</tr><tr>
								<td>5</td>
								<td>Furniture</td>
								<td>Table</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

