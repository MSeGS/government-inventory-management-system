@extends('layout.main')

@section('contentTop')

@stop

@section('content')

<div class="row dashboard-icons">
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-success btn-badge" >
			<i class="glyphicon glyphicon-align-left pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">25</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">New Indents</span>
		</a>
	</div>
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-primary btn-badge" >
			<i class="glyphicon glyphicon-list pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">25</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Requirements</span>
		</a>
	</div>
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-warning btn-badge" >
			<i class="glyphicon glyphicon-warning-sign pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">25</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Damage Reports</span>
		</a>
	</div>
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-danger btn-badge" >
			<i class="glyphicon glyphicon-sort-by-attributes-alt pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">25</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Out of Stock</span>
		</a>
	</div>
</div>

	<div class="row">
		<div class="col-md-5">
			<div class="panel panel-primary">
				<div class="panel panel-heading"><span class="glyphicon glyphicon-th"></span> Latest Indents</div>
				<div class="panel panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<th class="col-md-1">No.</th>
							<th class="col-md-4">Indentor</th>
							<th class="col-md-3">Indents total</th>
							<th class="col-md-3">Total Indents</th>
							<th>Status</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Gosa</td>
								<td>3</td>
								<td>10</td>
								<td>Dispatched</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Chhama</td>
								<td>3</td>
								<td>9</td>
								<td>Pending</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Chhama</td>
								<td>4</td>
								<td>8</td>
								<td>Approved</td>
							</tr>
							<tr class="warning">
								<td>4</td>
								<td>Chhama</td>
								<td>5</td>
								<td>7</td>
								<td>Partial Dispatched</td>
							</tr>
							<tr>
								<td>5</td>
								<td>Chhama</td>
								<td>6</td>
								<td>6</td>
								<td>Dispatched</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel panel-heading"><span class="glyphicon glyphicon-th"></span> Less Stock Products</div>
				<div class="panel panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<th class="col-md-1">No.</th>
							<th class="col-md-5">Product Name</th>
							<th>Quantity</th>
						</thead>
						
						<tbody>
							<tr>
								<td>1</td>
								<td>Paper Rims</td>
								<td>4</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Paper Rims</td>
								<td>4</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Paper Rims</td>
								<td>4</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Paper Rims</td>
								<td>4</td>
							</tr>
							<tr>
								<td>5</td>
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
				<div class="panel-heading">Notificationss</div>
				<div class="panel panel-body">
					
				</div>
			</div>
		</div>
	</div>
</div>
@stop


<script>

		var lineChartData = {
			labels : ["January","February","March","April","May","June","July"],
			datasets : [
				{
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : [65,59,90,81,56,55,40]
				},
				{
					fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : [28,48,40,19,96,27,100]
				}
			]
			
		}

	var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
	
	</script>
@stop