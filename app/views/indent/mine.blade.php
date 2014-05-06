@extends('layout.main')

@section('contentTop')
	{{Form::open(array('url'=>route('department.index'),'method'=>'get','class'=>''))}}
		<div class="row">
			<div class="col-md-2">
				<?php echo Form::select('status', $status, $filter['status'], array('class'=>'dropdown input-sm form-control'));?>
			</div>
			<div class="col-md-2">
				<div class="input-group">
					<?php echo Form::text('indent_date', $filter['indent_date'], array('class'=>'input-sm form-control','placeholder'=>_('Indent Date')));?>
					<span class="input-group-btn">
	    				<button class="btn-sm btn btn-default" name="search" value="Search" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
	  				</span>
				</div>
			</div>
		</div>
	{{Form::close()}}
@stop

@section('content')
<div class="col-md-12">
	<div class="row">
		@if(Session::has('error'))
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
		@endif

		@if(Session::has('message'))
		<div class="alert alert-success">
			{{Session::get('message')}}
		</div>
		@endif

		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th class="col-md-3"><?php echo _("Date") ?></th>
					<th class="col-md-1"><?php echo _("Indent Items") ?></th>
					<th class="col-md-1"><?php echo _("Requirements") ?></th>
					<th class="col-md-2"><?php echo _("Reference No") ?></th>
					<th class="col-md-2"><?php echo _("Status") ?></th>
					<th class="col-md-2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($indents as $key => $indent)
				<tr>
					<td>{{++$key}}</td>
					<td><a href="{{route('indent.show', array($indent->id))}}"><strong>{{date('j', strtotime($indent->indent_date)) . '<sup>' . date('S', strtotime($indent->indent_date)) . '</sup> ' . date('F Y, h:iA', strtotime($indent->indent_date))}}</strong></a></td>
					<td>{{sizeof($indent->items)}}</td>
					<td>{{sizeof($indent->requirements)}}</td>
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
					<td>{{$indent->reference_no}}</td>
					<td>
						{{Form::open(array('url'=>route('indent.destroy', $indent->id),'method'=>'delete'))}}

							<a href="{{route('indent.show', array($indent->id))}}" class="btn btn-xs btn-success tooltip-top" title="<?php echo _('Show Indent') ?>"><i class="fa fa-eye"></i></a>
							@if($current_user->hasAccess('indent.edit') && in_array($indent->status, array('pending_approval', 'rejected')))
							<a href="{{route('indent.edit', array($indent->id))}}" class="btn btn-xs btn-success tooltip-top" title="<?php echo _('Edit Indent') ?>"><i class="fa fa-pencil"></i></a>
							@endif
							@if($current_user->hasAccess('indent.destroy')  && in_array($indent->status, array('pending_approval', 'rejected')) )
							<button type="submit" onclick="return confirm('<?php echo _('Are you sure?') ?>');" name="id" class="btn btn-xs btn-danger tooltip-top" title="<?php echo _('Remove Indent') ?>" value="{{$indent->id}}"><i class="fa fa-times"></i></button>
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