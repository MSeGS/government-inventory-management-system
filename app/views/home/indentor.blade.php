@extends('layout.main')

@section('contentTop')
<div class="row"><h2>Welcome {{$current_user->full_name}}</h2></div>
@stop

@section('content')
<div class="row dashboard-icons">
	<div class="col-md-6">
			<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
			<a type="button" class="btn btn-default btn-badge" href="{{route('indent.mine')}}" >
				<i class="glyphicon glyphicon-align-left pull-left fa-4x"></i>
				<span class="text-right fa-4x counter pull-right">{{$indents}}</span>
				<div class="clearfix"></div>
				<span class="lead hidden-xs icon-title text-right">Total Indents</span>
			</a>
		</div>
		<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
			<a type="button" class="btn btn-warning btn-badge" href="{{route('indent.mine',array('status'=>'pending_approval'))}}">
				<i class="glyphicon glyphicon-list pull-left fa-4x"></i>
				<span class="text-right fa-4x counter pull-right">{{$pendingIndents}}</span>
				<div class="clearfix"></div>
				<span class="lead hidden-xs icon-title text-right">Pending Indents</span>
			</a>
		</div>
		<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-success btn-badge" href="{{route('indent.mine',array('status'=>'approved'))}}">
			<i class="glyphicon glyphicon-warning-sign pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">{{$approvedIndents}}</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Approved Indents</span>
		</a>
	</div>
	<div class="col-md-6 mb20 text-center col-xs-3 col-sm-3">
		<a type="button" class="btn btn-danger btn-badge" href="{{route('indent.mine',array('status'=>'rejected'))}}">
			<i class="glyphicon glyphicon-sort-by-attributes-alt pull-left fa-4x"></i>
			<span class="text-right fa-4x counter pull-right">{{$rejectedIndents}}</span>
			<div class="clearfix"></div>
			<span class="lead hidden-xs icon-title text-right">Rejected Indents</span>
		</a>
	</div>
	</div>
	<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel panel-heading"><span class="glyphicon glyphicon-th"></span> Indent Status</div>
				<div class="panel panel-body">
					<table class="table table-striped">
						<thead>
							<th class="col-md-1"><?php echo _('No.');?></th>
							<th class="col-md-2"><?php echo _('Date'); ?></th>
							<th class="col-md-1"><?php echo _('Indented'); ?></th>
							<th class="col-md-1"><?php echo _('Supplied'); ?></th>
							<th class="col-md-3"><?php echo _('Status'); ?></th>
						</thead>
						<tbody>
							@if($latestIndents)
							@foreach($latestIndents as $key=>$indent)
							<tr>
								<td>{{$key+1}}</td>
								<td><a href="{{url('indent', array('id'=>$indent->id))}}" >{{date('Y-m-d',strtotime($indent->indent_date))}}</a></td>
								<td>{{$indent->items->sum('quantity')}}</td>
								<td>{{$indent->items->sum('supplied')}}</td>
								<td>{{ucwords(str_replace('_',' ',$indent->status))}}</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td><?php echo _('Indents not found'); ?></td>
							</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
</div>


	
@stop

