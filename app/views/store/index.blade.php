@extends('layout.main')

@section('content')

<div class="row">
	<div class="col-md-8">
		<table class="table table-striped table-bordered">
				@if(Session::has('delete'))
					<div class="alert alert-danger">
				{{Session::get('delete')}}
				@endif	
			</div>
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-5"><?php echo _('Department') ?></th>
					<th class="col-md-3"><?php echo _('Store Code') ?></th>
					<th class="col-md-3"></th>
				</tr>
			</thead>
			<tbody>
				@if($stores->count())

				@foreach($stores as $key=>$store)
				<tr>
					<td>{{$index+$key}}</td>
					<td>{{$store->department->name}}</td>
					<td><strong>{{$store->store_code}}</strong></td>
					<td>
						{{Form::open(array('url'=>route('store.destroy', $store->id), 'method'=>'delete'))}}
						<a href="{{route('store.edit', array($store->id, 'page='.$stores->getCurrentPage()))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Store"><i class="fa fa-pencil"></i></a>
						@if($current_user->hasAccess('resource.edit'))
						<button type="submit" onclick="return confirm('Are you sure?');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove Store" value="{{$store->id}}"><i class="fa fa-times"></i></a>
						@endif
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
				@else
				<tr><td colspan="4" class="text-center text-danger"><em>{{_("Right now, we don't have store to display. Create store on the right side.")}}</em></td></tr>
				@endif
			</tbody>
		</table>
		{{$stores->links()}}
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading"><h5 class="text-center"><?php echo _('New Store') ?></h5></div>
			<div class="panel-body">

				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}	
				</div>
			
				@endif
			
				{{Form::open(array('url'=>route('store.index'), 'method'=>'post', 'class'=>'form-vertical'))}}

				<div class="form-group">
					{{Form::label('department_id', _('Department'), array('class'=>'control-label'))}}
					{{Form::select('department_id', $departments, Input::old('department_id'), array('class'=>'form-control input-sm'))}}
				</div>

				<div class="form-group">
					{{Form::label('store_code', _('Store Code'), array('class'=>'control-label'))}}
					{{Form::text('store_code', Input::old('store_code'), array('class'=>'form-control input-sm'))}}

					@if($errors->has('store_code'))
					<p class="help-block"><span class="text-danger">{{$errors->first('store_code')}}</span></p>
					@endif
				</div>

				<div class="form-group text-right">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Submit') ?></button>
				</div>

				{{Form::close()}}

			</div>
		</div>
	</div>
</div>
@stop