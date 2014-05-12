@extends('layout.main')
@section('content')
<div class="row">
	<ul class="nav nav-tabs">
		<li ><a href="{{route('report.product')}}">Tabular Report</a>	</li>
		<li class="active"><a href="{{route('report.product-graphic')}}">Graphical Report</a></li>
		<li><a href="{{route('report.product-detail')}}">Detail Report</a></li>
	</ul>
	<div class="mb20"></div>
	<div class="lead mb20">
		<?php echo _('products Procurement/Indent Overview <small>for</small>'); ?>
		<div class="btn-group">
			<button type="button" class="btn btn-default chart-button">{{date('Y')}}</button>
			<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
				<span class="sr-only">Click to select year</span>
			</button>
			<ul class="dropdown-menu" id="year_selector" role="menu">
				@foreach($years as $year)
				<li ><a data-year="{{$year}}" href="javascript:;">{{$year}}</a></li>
				@endforeach
			</ul>
		</div>
	</div> 
	<div class="col-md-9 mb20" >
		
		
		
		<div class="mb20"></div>

		<div class="chart-container">
			<div class="chart-wrap">
				<div class="loading" style="display:none">
					<img src="/templates/default/images/loading.svg" alt="Loading icon" />
					<span><?php echo _('Please Wait'); ?></span>
				</div>
				<div id="year_graph" style="height:400px">
					
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><?php echo _('Products'); ?></div>
			<div class="panel-body" id="legends"></div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<link rel="stylesheet" type="text/css" href="{{asset('templates/default/css/super.home.css')}}" />
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.pie.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.time.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.growraf.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.spline.js')}}"></script>
<script type="text/javascript">
$(function () {
	var options = {
		container: $('#year_graph'),
		url:'/report/admin-ajax',
		loading:$('.loading'),
		data:{
			year:'2014',
			type:'product'
		},
		extraInfo:true,
		options:{
			legend:{
				container:$('#legends'),
				labelFormatter:function(label,series){
					return '<a href="/report/product-detail/'+series.indentor_id+'/'+$('.chart-button').text()+'">'+label+'</label>';
				}
			}
		}
	};
	plotter.init(options);

	$('#year_selector li a').click(function(){
		options.data.year = $(this).data('year');
		$('.chart-button').text($(this).data('year'));
		plotter.init(options);
	})
});
</script>
@stop