@extends('layout.main')

@section('contentTop')

@stop

@section('content')
<?php $counter = $counts[0]; ?>
<div class="row dashboard-icons">
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-success btn-badge" >
			<i class="glyphicon glyphicon-user pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">{{$counter->adminsCount + $counter->indentorsCount + $counter->storeKeepersCount }} </span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Registered Users</span>
		</a>
	</div>
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-info btn-badge" >
			<i class="glyphicon glyphicon-home pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">{{$counter->storesCount}} </span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Stores</span>
		</a>
	</div>
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-warning btn-badge" >
			<i class="glyphicon glyphicon-warning-sign pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">{{$counter->departmentsCount}}</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Departments</span>
		</a>
	</div>
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<div id="users_pie" style="height:140px">
			
		</div>
	</div>
</div>
<div class="row mb20 chart-wrap">
	<div class="col-md-12 mb20" >
		<div class="lead ">
			Monthly Statistics 
			<small>for</small> 
			<div class="btn-group">
				<button type="button" class="btn btn-default chart-button">{{date('Y')}}</button>
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
					<span class="sr-only">Click to select year</span>
				</button>
				<ul class="dropdown-menu" role="menu">
					@foreach($years as $year)
					<li ><a data-year="{{$year}}" onclick="ajaxChart('#month_chart','/ajax-super/month/{{$year}}','{{$year}}',true)" href="javascript:;">{{$year}}</a></li>
					@endforeach
				</ul>
			</div>
		</div> 
		
		
		<div class="mb20"></div>

		<div class="chart-container"  >
			<div id="month_chart" style="height:200px">
				
			</div>
			<div class="loading">
				<img src="/templates/default/lib/loading/loading-spin.svg" alt="Loading icon" />
			</div>
		</div>
	</div>
</div>
<div class="row mb20 charts-wrap hidden">
	<div class="col-md-12 mb20" >
		<div class="lead ">
			Overall Statistics 
		</div> 
		
		<div class="chart-container"  >
			<div id="overall_chart" style="height:300px">
				
			</div>
			<div class="loading">
				<img src="/templates/default/lib/loading/loading-spin.svg" alt="Loading icon" />
			</div>
		</div>
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
<style type="text/css">
	
</style>
@stop


@section('scripts')
<link rel="stylesheet" type="text/css" href="{{asset('templates/default/css/super.home.css')}}" />
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.min.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.pie.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/lib/flot/grow.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.spline.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/js/super.home.js')}}"></script>
@stop