@extends('layout.main')
@section('contentTop')
<div class="row">
	<div class="col-md-12 ">
		<h1><?php echo _("Detailed Report <small>for</small> "); ?>{{$product->name}}</h1>
	</div>
	<ul class="nav nav-tabs">
		<li ><a href="{{route('report.product')}}">Tabular Report</a>	</li>
		<!-- <li class="active"><a href="{{route('report.product-graphic')}}">Graphical Report</a></li> -->
		<li class="active"><a href="{{route('report.product-detail')}}">Detailed Report</a></li>
	</ul>
</div>
@stop
@section('content')
<div class="row">
	<div class="col-md-8 mb20" >
	@if($indented)
	<table class="table">
		<thead >
			<tr>
				<th>Sl No</th>
				<th>Date Indented</th>
				<th>Quantity Indented</th>
				<th>Quantity Supplied</th>
			</tr>
		</thead>
		<tbody>
			@if($indented->count() == 0)
			<tr class="warning text-center">
				<td colspan="4"><?php echo _("Product not indented yet."); ?></td>
			</tr>
			@endif
			@foreach($indented as $key=>$item)
			<tr>
				<td>{{$key+1}}</td>
				<td><a href="{{route('indent.index', array('indent_date'=>$item->indent_date))}}" title="View indents on this date">{{$item->indent_date}}</a></td>
				<td>{{$item->qty}}</td>
				<td>{{$item->supplied}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{$indented->links()}}
	@endif
	</div>
	<div class="col-md-4">
		<div class="chart-container">
			<div class="chart-wrap">
				<div class="loading" style="display:none">
					<img src="/templates/default/images/loading.svg" alt="Loading icon" />
					<span><?php echo _('Please Wait'); ?></span>
				</div>
				<div id="product_graph" style="height:200px">
					
				</div>
			</div>
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
var productId = {{$product->id}};
$(function () {
	var options = {
		container: $('#product_graph'),
		url:'/report/admin-ajax',
		loading:$('.loading'),
		data:{
			id:productId,
			type:'product-detail'
		},
		extraInfo:false,
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