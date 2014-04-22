@extends('layout.main')

@section('content')
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="col-md-1">#</th>
							<th><?php echo _("Product Name") ?></th>
							<th class="col-md-2"><?php echo _("Category") ?></th>
							<th class="col-md-2"><?php echo _("Quantity") ?></th>
							<th class="col-md-2"><?php echo _("Report Date") ?></th>
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
								{{Form::open(array('url'=>route('damage.destroy'), 'method'=>'delete'))}}
								@if($current_damage->id == $damage->id)
								<a href="{{route('damage.edit', array($damage->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="<?php echo _('Edit Damage Report') ?>"><i class="fa fa-pencil"></i></a>
								@else
								<a href="{{route('damage.edit', array($damage->id))}}" class="btn btn-xs btn-success tooltip-top" title="<?php echo _('Edit Damage Report') ?>"><i class="fa fa-pencil"></i></a>
								@endif
								<button type="submit" onclick="return confirm <?php echo _('Are you sure') ?>;" name="id" class="btn btn-xs btn-danger tooltip-top" title="<?php echo _('Remove Damage Item') ?>" value="{{$damage->id}}"><i class="fa fa-times"></i></button>
								{{Form::close()}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{{$damages->links()}}

			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="panel panel-default" >
			<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Edit Damage Report');?></h5></div>
				<div class="panel-body">

					@if(Session::has('message'))
					<div class="alert alert-success">
						{{Session::get('message')}}	
					</div>
					@endif

					{{Form::open(array('url'=>route('damage.update',array($current_damage->id)),'method'=>'put','class'=>'form-vertical'))}}
						<div class="form-group">
							<?php echo Form::label('reported_at', _('Report Date'), array('class'=>'control-label')) ?>
							{{Form::text('reported_at', Input::old('reported_at', $current_damage->reported_at),  array('class'=>'datepicker input-sm form-control', 'placeholder'=>'Pick a date'))}}
						</div>

						<div class="form-group">
							<?php echo Form::label('quantity', _('Quantity'), array('class'=>'control-label')) ?>
							{{Form::text('quantity', Input::old('quantity', $current_damage->quantity),  array('class'=>'input-sm form-control'))}}
						</div>

						<div class="form-group">
							<?php echo Form::label('note', _('Note'), array('class'=>'control-label')) ?>
							{{Form::textarea('note', Input::old('note', $current_damage->note), array('class'=>'input-sm form-control','rows'=>'2'))}}
						</div>

						<div class="form-group text-right">
							<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
							<a href="{{route('damage.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
						</div>
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
@stop