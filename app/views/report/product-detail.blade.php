@extends('layout.main')
@section('contentTop')
<div class="row">
	<div class="col-md-12 ">
		<h1><?php echo _("Detailed Report <small>for</small> "); ?>{{$product->name}}</h1>
	</div>
	<ul class="nav nav-tabs">
		<li ><a href="{{route('report.product')}}">Tabular Report</a>	</li>
		<!-- <li class="active"><a href="{{route('report.product-graphic')}}">Graphical Report</a></li> -->
		<li class="active"><a href="{{route('report.product-detail')}}">Detail Report</a></li>
	</ul>
</div>
@stop
@section('content')
<div class="row">
	<div class="col-md-9 mb20" >
	<ul>
		<li><strong><?php echo _('Name'); ?></strong> <span>{{$product->name}}</span></li>
		<li><strong><?php echo _('In Stock'); ?></strong> <span>{{$product->in_stock}}</span></li>
	</ul>
	</div>
</div>
@stop

@section('scripts')
<link rel="stylesheet" type="text/css" href="{{asset('templates/default/css/super.home.css')}}" />
@stop