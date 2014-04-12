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
					<th><?php echo _("Product Name") ?></th>
					<th class="col-md-2"><?php echo _("Category") ?></th>
					<th class="col-md-1"><?php echo _("Quantity") ?></th>
					<th class="col-md-2"><?php echo _("Report Date") ?></th>
					<th class="col-md-2"><?php echo _("Status") ?></th>
					<th class="col-md-2"></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; ?>
				@foreach($damages as $damage)
				<tr>
					<td>{{++$i}}</td>
					<td>{{$damage->product->name}}
						<br>
						<span class="text-muted"><small>{{$damage->note}}</small></span>
					</td>
					<td>{{$damage->product->category->category_name}}</td>
					<td>{{$damage->quantity}}</td>
					<td>{{date('dS F, Y h:iA', strtotime($damage->reported_at))}}</td>
					<td>{{ucfirst($damage->status)}}</td>
					<td>
						{{Form::open(array('url'=>'damage/'.$damage->id, 'method'=>'delete'))}}
						<a href="{{route('damage.edit', array($damage->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Department"><i class="fa fa-pencil"></i></a>
						<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Department" value="{{$damage->id}}"><i class="fa fa-times"></i></button>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$damages->links()}}

	
	</div>
</div>
@stop