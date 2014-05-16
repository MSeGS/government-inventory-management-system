@extends('layout.main')

@section('contentTop')
<div class="row"><h2>Welcome {{$current_user->full_name}}</h2></div>
@stop

@section('content')

<div class="row dashboard-icons">
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-success btn-badge" href="{{route('indent.index',array('status'=>'pending_approval'))}}" >
			<i class="glyphicon glyphicon-align-left pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">{{$pendingIndents}}</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Pending Indents</span>
		</a>
	</div>
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-primary btn-badge muted" href="{{route('indent.index',array('status'=>'pending_approval'))}}" >
			<i class="glyphicon glyphicon-list pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">{{$pendingRequirements}}</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Requirements</span>
		</a>
	</div>
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-warning btn-badge" href="{{route('damage.manage')}}" >
			<i class="glyphicon glyphicon-warning-sign pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">{{$pendingDamages}}</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Damage Reports</span>
		</a>
	</div>
	<div class="col-md-3 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-danger btn-badge"  href="{{route('product.index',array('status'=>'out_of_stock'))}}" >
			<i class="glyphicon glyphicon-sort-by-attributes-alt pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">{{$outOfStock}}</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Out of Stock</span>
		</a>
	</div>
</div>
<!-- <div class="row">
	<div class="col-md-9 mb20" >
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
				{{--
					@foreach($years as $year)
					<li ><a data-year="{{$year}}" onclick="ajaxChart('#month_chart','/ajax-super/month/{{$year}}','{{$year}}',true)" href="javascript:;">{{$year}}</a></li>
					@endforeach
					--}}
				</ul>
			</div>
		</div> 
		
		
		<div class="mb20"></div>

		<div class="chart-container">
			<div class="chart-wrap">
				<div class="loading" style="display:none">
					<img src="/templates/default/images/loading.svg" alt="Loading icon" />
					<span>Please Wait</span>
				</div>
				<div id="year_graph" style="height:400px">
					
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-warning">
			<div class="panel-heading"><span class="fa fa-exclamation "></span> Notificationss</div>
			<div class="panel panel-body">
				
			</div>
		</div>
	</div>
</div> -->
	<div class="row">
		<div class="col-md-5">
			<div class="panel panel-primary">
				<div class="panel-heading"><span class="glyphicon glyphicon-th"></span> Latest Indents</div>
				<div class="panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<th class="col-md-1">No.</th>
							<th class="col-md-4">Indentor</th>
							<th class="col-md-3">Total Indents</th>
							<th>Status</th>
						</thead>
						<tbody>
						@if($latestIndents->count() > 0)
							@foreach($latestIndents as $key => $indent)
							<tr>
								<td>{{$key + 1}}</td>
								<td>{{$indent->indentor->full_name}}</td>
								<td>{{$indent->items->count()}}</td>
								<td>{{ucwords($indent->status)}}</td>
							</tr>
							@endforeach
						@else
							<tr class="text-center warning"><td colspan="4" ></td></tr>
						@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading"><span class="glyphicon glyphicon-th"></span> Less Stock Products</div>
				<div class="panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<th class="col-md-1">No.</th>
							<th class="col-md-5">Product Name</th>
							<th class="col-md-1">Quantity</th>
						</thead>
						
						<tbody>
							@if($lowStockItems->count() > 0)
							@foreach($lowStockItems as $key=>$item)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$item->name}}</td>
								<td>{{$item->in_stock}}</td>
							</tr>
							@endforeach
							@else
							<tr class="text-center warning"><td colspan="3"><?php echo ('No Low stock items'); ?></td></tr>
							@endif
						</tbody>
					</table>
				</div>	
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading"> <span class="glyphicon glyphicon-envelope"></span> <?php echo _('Latest Messages'); ?></div>
				<div class="panel panel-body">
					<table class="table table-striped table-hover">
						<thead>
							<th class="col-md-1">No.</th>
							<th class="col-md-5">From</th>
							<th>Date</th>
						</thead>
						
						<tbody>
							@if($latestNotifications->count() > 0)
							@foreach($latestNotifications as $k=>$n)
							<tr class="{{$n->status == 'unread'?'danger':''}}">
								<td>{{$k + 1}}</td>
								<td>{{$n->sender->full_name}}</td>
								<td>{{$n->created_at}}</td>
							</tr>
							@endforeach
							@else
							<tr class="text-center warning"><td colspan="3">No Notifications</td></tr>
							@endif
						</tbody>
					</table>
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
<script type="text/javascript" src="{{asset('templates/default/lib/flot/grow.js')}}"></script>
<script type="text/javascript" src="{{asset('templates/default/lib/flot/jquery.flot.spline.js')}}"></script>
<script type="text/javascript">
$(function () {
	plotter.init({
		container: $('#year_graph'),
		url:'/ajax-admin',
		loading:$('.loading'),
		data:{
			year:'2014',
			type:'year '
		}
	})
})
</script>
@stop