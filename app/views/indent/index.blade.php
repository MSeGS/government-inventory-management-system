@extends('layout.main')

@section('content')
<div class="col-md-12">
	<div class="row">
		@if(Session::has('delete'))
		<div class="alert alert-danger">
			{{Session::get('delete')}}
		</div>
		@endif

		

			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-md-1">#</th>
						<th><?php echo _("Indentor") ?></th>
						<th class="col-md-1"><?php echo _("Indent Items") ?></th>
						<th class="col-md-1"><?php echo _("Requirements") ?></th>
						<th class="col-md-2"><?php echo _("Date") ?></th>
						<th class="col-md-2"><?php echo _("Status") ?></th>
						<th class="col-md-1"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($indents as $key => $indent)
					<tr>
						<td>{{++$key}}</td>
						<td>{{$indent->indentor->username}}
							<br>
							<span class="text-muted"><small>{{$indent->indentor->designation}}</small></span>
						</td>
						<td>{{sizeof($indent->items)}}</td>
						<td></td>
						<td>{{date('dS F Y, h:iA', strtotime($indent->indent_date))}}</td>
						<td>
							@if($indent->status == 'approved')
							<span class="text-info">
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

							<a href="{{route('indent.edit', array($indent->id))}}" class="btn btn-xs btn-success tooltip-top" title="<?php echo _('Edit Indent') ?>"><i class="fa fa-pencil"></i></a>
							<button type="submit" onclick="return confirm <?php echo _('Are you sure') ?>);" name="id" class="btn btn-xs btn-danger tooltip-top" title="<?php echo _('Remove Indent') ?>" value="{{$indent->id}}"><i class="fa fa-times"></i></button>
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