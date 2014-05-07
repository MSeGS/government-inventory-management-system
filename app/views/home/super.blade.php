@extends('layout.main')

@section('contentTop')

@stop

@section('content')
<?php $counter = $counts[0]; ?>
<div class="row dashboard-icons">
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-success btn-badge" href="/user">
			<i class="glyphicon glyphicon-user pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">{{$counter->adminsCount + $counter->indentorsCount + $counter->storeKeepersCount }} </span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Registered Users</span>
		</a>
	</div>
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-info btn-badge" href="/store" >
			<i class="glyphicon glyphicon-home pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">{{$counter->storesCount}} </span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Stores</span>
		</a>
	</div>
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-warning btn-badge" href="/department">
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

		<div class="chart-container">
			<div class="chart-wrap">
				<div class="loading">
					<img src="/templates/default/images/loading.svg" alt="Loading icon" />
					<span>Please Wait</span>
				</div>
				<div id="month_chart" style="height:400px">
					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mb20 charts-wrap hidden">
	<div class="col-md-12 mb20" >
		<div class="lead ">
			Overall Statistics 
		</div> 
		
		<div class="chart-container">
			<div class="chart-wrap">
				<div class="loading">
					<img src="/templates/default/images/loading.svg" alt="Loading icon" />
				</div>
				<div id="overall_chart" style="height:300px">
				
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mb20 charts-wrap">
	<div class="col-md-6 mb20" >
		<div class="lead ">
			Users Growth Chart
		</div> 
		
		<div class="chart-container">
			<div class="chart-wrap">
				<div class="loading">
					<img src="/templates/default/images/loading.svg" alt="Loading icon" />
					<span>Please Wait</span>
				</div>
				<div id="users_chart" style="height:150px">
					
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 mb20" >
		<div class="lead ">
			Stores Growth Chart
		</div> 
		
		<div class="chart-container">
			<div class="chart-wrap">
				<div class="loading">
					<img src="/templates/default/images/loading.svg" alt="Loading icon" />
					<span>Please Wait</span>
				</div>
				<div id="users_chart" style="height:150px">
					
				</div>
			</div>
		</div>
	</div>
</div>
@stop


@section('scripts')
<link rel="stylesheet" type="text/css" href="{{asset('templates/default/css/super.home.css')}}" />
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.min.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.pie.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/lib/flot/grow.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.spline.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/js/super.home.js')}}"></script>
@stop