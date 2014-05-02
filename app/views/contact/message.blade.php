@extends('layout.main')
@section('content')
	<div class="row">
		<div class="col-md-7">
			{{Form::open(array('url'=>route('contact.message'), 'method'=>'get'))}}
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th >#</th>
							<th class="col-md-3">Name</th>
							<th class="col-md-4">Department</th>
							<th class="col-md-1">Status</th>
							<th class="col-md-3"></th>
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
								<a href="{{route('contact.edit', $contact->id)}}" class="btn btn-sm btn-primary">Read / Reply</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			{{Form::close()}}
		</div>
		<div class="col-md-5">
			<div class="panel panel-primary">
				<div class="panel panel-heading">
					Read / Reply
				</div>
				<div class="panel panel-body">
					<table class="table"> 
						<tbody>
							<tr>
								<th>Name</th>
								<td></td>
							</tr>
							<tr>
								<th>Department</th>
								<td></td>
							</tr>
							<tr>
								<th>Phone No.</th>
								<td></td>
							</tr>
							<tr>
								<th>Email</th>
								<td></td>
							</tr>
							<tr>
								<th>Note</th>
								<td></td>
							</tr>
							<tr>
								<th></th>
								<td><textarea rows="8" cols="60"></textarea><a href="" class="btn btn-sm btn-primary pull-right">Reply</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop