@extends('layout.main')
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th class="col-md-1">#</th>
						<th>Name</th>
						<th class="col-md-3">Department</th>
						<th class="col-md-1">Status</th>
						<th class="col-md-2"></th>
					</tr>
				</thead>
				<tbody>
					@foreach($contacts as $key=>$contact)
					<tr>
						<td>{{$key+1}}</td>
						<td>{{$contact->name}}</td>
						<td>{{$contact->department}}</td>
						<td>{{$contact->status}}</td>
						<td>
							<a href="{{route('contact.edit', $contact->id)}}" class="btn btn-sm btn-primary">View Details</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop