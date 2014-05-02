@extends('layout.main')
@section('content')
	<div class="row">
		<div class="col-md-7">
			{{Form::open(array('url'=>route('contact.update'), 'method'=>'get'))}}
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
						<thead>
							<tr>
								<th class="col-md-4"></th>
								<th class="col-md-8"></th>
							</tr>
						</thead>
						{{Form::model($contactById, array('url'=>route('contact.update', $contactById->id), 'method'=>'put'))}}
							<tbody>
								<tr>
									<th>Name</th>
									<td>{{$contactById->name}} </td>
								</tr>
								<tr>
									<th>Department</th>
									<td>{{$contactById->department}}</td>
								</tr>
								<tr>
									<th>Phone No.</th>
									<td>{{$contactById->phone_no}}</td>
								</tr>
								<tr>
									<th>Email</th>
									<td>{{$contactById->email}}</td>
								</tr>
								<tr>
									<th>Note</th>
									<td>{{$contactById->note}}</td>
								</tr>
								<tr>
									{{Form::open(array('url'=>route('contact.update', $contactById), 'method'=>'put'))}}
										<th></th>
										<td>
											<div class="form-group">
												{{Form::textarea('mail_text', '', array('rows'=>'10', 'cols'=>'50'))}}
											</div>
											{{Form::submit('Reply', array('class'=>'btn btn-sm btn-primary pull-right'))}}
										</td>
									{{Form::close()}}
								</tr>
							</tbody>
						{{Form::close()}}
					</table>
				</div>
			</div>
		</div>
	</div>
@stop