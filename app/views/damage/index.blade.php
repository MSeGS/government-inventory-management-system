@extends('layout.main')

@section('content')
<div class="col-md-12">
	<div class="col-md-8">
		@if(Session::has('delete'))
		<div class="alert alert-danger">
		{{Session::get('delete')}}	
		</div>
		@endif
		
		{{Form::close()}}
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-md-1">#</th>
						<th class="col-md-2"><?php echo _("Product Name") ?></th>
						<th class="col-md-2"><?php echo _("Damage quantity") ?></th>
						<th class="col-md-2"><?php echo _("Report Date") ?></th>
						<th class="col-md-2"><?php echo _("Status") ?></th>
						<th class="col-md-1"></th>
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
						<td>{{$damage->quantity}}</td>
						<td>{{$damage->report_at}}</td>
						<td>{{$damage->status}}</td>
						<td>
							{{Form::open(array('url'=>'damage/'.$damage->id, 'method'=>'delete'))}}
							<a href="{{route('damage.edit', array($damage->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Department"><i class="fa fa-pencil"></i></a>
							<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Department" value="{{$damage->id}}"><i class="fa fa-times"></i></a>
							{{Form::close()}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$damages->links()}}
	</div>

	<div class="col-md-4">
		<div class="panel panel-default" >
			<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Product Damage');?></h5></div>
				<div class="panel-body">

					@if(Session::has('message'))
					<div class="alert alert-success">
						{{Session::get('message')}}	
					</div>
					@endif

					{{Form::open(array('url'=>route('damage.index'),'method'=>'post','class'=>'form-vertical'))}}
					
					<div class="form-group">
					<?php echo Form::label('category', _('Category'), array('class'=>'control-label')) ?>
					{{Form::select('category', $categorySelect, 'null',array('class' =>'dropdown input-sm form-control'))}}
					</div>	

					<div class="form-group">
					<?php echo Form::label('name', _('Product Name'), array('class'=>'control-label')) ?>
					{{Form::select('name', $productSelect, 'null',array('class' =>'dropdown input-sm form-control'))}}
					</div>

					<div class="form-group">
						<?php echo Form::label('report_at', _('Report Date'), array('class'=>'control-label')) ?>
						<input type="text" name='report_at' class="datepicker form-control">
					</div>

					<div class="form-group">
					<?php echo Form::label('quantity', _('Quantity'), array('class'=>'control-label')) ?>
					{{Form::text('quantity', '',  array('class'=>'input-sm form-control'))}}
					</div>

					<div class="form-group">
					<?php echo Form::label('note', _(''), array('class'=>'control-label')) ?>
					{{Form::textarea('note', '', array('class'=>'input-sm form-control','rows'=>'2'))}}
					</div>

					<div class="form-group text-right">
						<button type="submit" class="btn btn-sm btn-primary"><?php echo _('Submit');?></button>
					</div>
				</div>
		</div>
			{{Form::close()}}
	</div>
</div>
@stop