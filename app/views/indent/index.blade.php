@extends('layout.main')

@section('contentTop')
	{{Form::open(array('url'=>route('indent.index'),'method'=>'get','id'=>'indent_filter'))}}
		@include('indent._search')
	{{Form::close()}}
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		@if(Session::has('delete'))
		<div class="alert alert-danger">
			{{Session::get('delete')}}
		</div>
		@endif
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th class="col-md-2"><?php echo _("Indentor") ?></th>
						<th class="col-md-2"><?php echo _("Date") ?></th>
						<th class="col-md-1"><?php echo _("Indent Items") ?></th>
						<th class="col-md-1"><?php echo _("Requirements") ?></th>
						<th class="col-md-1"><?php echo _("Reference No") ?></th>
						<th class="col-md-2"><?php echo _("Status") ?></th>
						<th class="col-md-2"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($indents as $key => $indent)
					<tr>
						<td>{{++$key}}</td>
						<td>{{$indent->indentor->full_name}}
							<br>
							<span class="text-muted"><small>{{$indent->indentor->designation}}</small></span>
						</td>
						<td>{{date('dS F Y, h:iA', strtotime($indent->indent_date))}}</td>
						<td>{{sizeof($indent->items)}}</td>
						<td>{{sizeof($indent->requirements)}}</td>
						<td>{{$indent->reference_no}}</td>
						<td>
							@if($indent->status == 'approved')
							<span class="text-primary">
							@elseif($indent->status == 'rejected')
							<span class="text-danger">
							@elseif(in_array($indent->status, array('partial_dispatched', 'dispatched')))
							<span class="text-success">
							@elseif($indent->status == 'pending_approval')
							<span class="text-warning">
							@endif

							{{ucwords(str_replace('_', ' ', $indent->status))}}
							</span>
						</td>
						<td>
							{{Form::open(array('url'=>route('indent.destroy', array($indent->id)),'method'=>'delete'))}}
							@if($current_user->hasAccess('indent.show'))
							<a href="{{route('indent.show', array($indent->id))}}" class="btn btn-xs btn-success tooltip-top" title="<?php echo _('View Indent') ?>"><i class="fa fa-eye"></i></a>
							@endif
							@if($current_user->hasAccess('indent.process') && !in_array($indent->status, array('partial_dispatched', 'dispatched')))
							<a href="{{route('indent.process', array($indent->id))}}" class="btn btn-xs btn-primary tooltip-top" title="<?php echo _('Process Indent') ?>"><i class="fa fa-cog"></i> <?php echo _('Process'); ?></a>
							@endif

							@if($current_user->hasAccess('indent.dispatch') && $indent->status != 'rejected')
							<a href="{{route('indent.dispatch', array($indent->id))}}" class="btn btn-xs btn-success tooltip-top" title="<?php echo _('Dispatch Indent') ?>"><i class="fa fa-truck"></i> <?php echo _('Dispatch'); ?></a>
							@endif
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$indents->links()}}
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
$(function(){

    $('#indent_status').on('change', function(){
        $('#indent_filter').submit();
    });
});
$(function(){

    $('#indent_day').on('change', function(){
        $('#indent_filter').submit();
    });
});
</script>
@stop