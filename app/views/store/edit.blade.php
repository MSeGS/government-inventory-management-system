@extends('layout.main')

@section('content')

<div class="col-md-8">
	<div class="row">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-5"><?php echo _('Department') ?></th>
					<th class="col-md-3"><?php echo _('Store Code') ?></th>
					<th class="col-md-3"></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; ?>

				@if($stores->count())

				@foreach($stores as $store)
				<tr {{($current_store->id == $store->id)?'class="success"':''}}>
					<td>{{++$i}}</td>
					<td>{{$store->department->name}}</td>
					<td><strong>{{$store->store_code}}</strong></td>
					<td>
						{{Form::open(array('url'=>route('store.destroy', $store->id), 'method'=>'delete'))}}
						
						@if($current_store->id == $store->id)
						<a href="{{route('store.edit', array($store->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="Edit Store"><i class="fa fa-pencil"></i></a>
						@else
						<a href="{{route('store.edit', array($store->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Store"><i class="fa fa-pencil"></i></a>
						@endif

						<button type="submit" onclick="return confirm('Are you sure?');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Store" value="{{$store->id}}"><i class="fa fa-times"></i></a>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach

				@else

				<tr><td colspan="4" class="text-center text-danger"><em>{{_("Right now, we don't have store to display. Create store on the right side.")}}</em></td></tr>

				@endif
			</tbody>
		</table>
	</div>	

	{{$stores->links()}}
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center"><?php echo _('Edit Store Code') ?>e</h5></div>
		<div class="panel-body">

			@if(Session::has('message'))
			<div class="alert alert-success">
				{{Session::get('message')}}	
			</div>
			@endif

			{{Form::open(array('url'=> route('store.update', $current_store->id), 'method'=>'put', 'class'=>'form-vertical'))}}

			<div class="form-group">
				{{Form::label('store_code', 'Store Code', array('class'=>'control-label'))}}
				{{Form::text('store_code', Input::old('store_code', $current_store->store_code), array('class'=>'form-control input-sm'))}}

				@if($errors->has('store_code'))
				<p class="help-block"><span class="text-danger">{{$errors->first('store_code')}}</span></p>
				@endif
			</div>

			<div class="form-inline text-right">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
				</div>
				<div class="form-group">
					<a href="{{route('store.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
				</div>
			</div>	

			{{Form::close()}}

		</div>
	</div>
</div>
@stop