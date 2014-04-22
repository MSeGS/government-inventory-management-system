@extends('layout.main')

@section('content')
<div class="col-md-12">
	<div class="row">
		@if(Session::has('delete'))
		<div class="alert alert-danger">
			{{Session::get('delete')}}
		</div>
		@endif

		<div class="col-md-12">
			<div class="row">
				{{Form::open(array('url'=>route('damage.manage'),'method'=>'get','class'=>'form-vertical'))}}
					<div class="col-md-2">
						<div class="form-group">
							{{Form::select('category', $categorySelect, 'null', array('class' =>'dropdown input-sm form-control'))}}
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<div class="input-group">
								<?php if(isset($_GET['prodsearch'])) { $prodsearch=$_GET['prodsearch'];} else { $prodsearch='';} ?>
								<?php echo Form::text('prodsearch',$prodsearch, array('class'=>'input-sm form-control','placeholder'=>_('Search Product')));?>
			      				<span class="input-group-btn">
			        				<button class="input-sm btn btn-default" name="search" value="Search" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
			      				</span>
				    		</div>
						</div>
					</div>
					
				{{Form::close()}}
			</div>
		</div>

		<div class="col-md-12">
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
						<td>
							@if($damage->status == 'declined')
							<span class="label label-danger">
							@elseif($damage->status == 'approved')
							<span class="label label-success">
							@elseif($damage->status == 'pending')
							<span class="label label-warning">
							@endif
								{{strtoupper($damage->status)}}
							</span>
						</td>
						<td class="tools">
							@if($damage->status == 'pending' || $damage->status == 'declined')
								{{Form::open(array('url'=>route('damage.approve', $damage->id), 'method'=>'post', 'style'=>'display:inline'))}}	
									{{Form::button('<i class="fa fa-check"></i> Approve', array('value'=>$damage->id, 'type'=>'submit', 'name'=>'id', 'class'=>'btn btn-xs btn-success'))}}
								{{Form::close()}}
							@endif

							@if($damage->status == 'pending' || $damage->status == 'approved')
								{{Form::open(array('url'=>route('damage.decline', $damage->id), 'method'=>'post', 'style'=>'display:inline'))}}
									{{Form::button('<i class="fa fa-times"></i> Decline', array('value'=>$damage->id, 'type'=>'submit', 'name'=>'id', 'class'=>'btn btn-xs btn-danger'))}}
								{{Form::close()}}
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{$damages->links()}}

		</div>
	</div>
</div>
@stop