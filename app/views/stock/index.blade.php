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
				<th>#</th>
				<th class="col-md-2">Category</th>
				<th class="col-md-2">Product</th>
				<th class="col-md-3">Note</th>
				<th class="col-md-2">Stock Quantity</th>
				<th class="col-md-2">Stock Date</th>
				<th class="col-md-1"></th>
			</thead>
			<tbody>
				@foreach($stocks as $key=>$stock)
				<tr>
					<td>{{$index+$key}}</td>
					<td>{{$stock->category->category_name}}</td>
					<td>{{$stock->product->name}} </td>
					<td>{{$stock->note}} </td>
					<td>{{$stock->quantity}}</td>
					<td>{{date('d/m/Y, h:iA', strtotime($stock->created_at))}}</td>
					<td>
						{{Form::open(array('url'=>route('stock.destroy', array($stock->id)), 'method'=>'delete'))}}
						@if($current_user->hasAccess('stock.edit'))
						<a href="{{route('stock.edit', array($stock->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit Stock Quantity"><i class="fa fa-pencil"></i></a>
						@endif
						@if($current_user->hasAccess('stock.destroy'))
						<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove stock" value="{{$stock->id}}"><i class="fa fa-times"></i></button>
						@endif
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	{{$stocks->links()}}
</div>
@stop
