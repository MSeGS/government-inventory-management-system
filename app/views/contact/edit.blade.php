@extends('layout.main')
@section('content')
	<div class="row">
		
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5 class="text-left">Contact From: {{$contactById->name}}</h5>
				</div>
				<div class="panel panel-body">
					<div class="col-md-6">
						<div class="form-group">
							{{Form::label('name', 'Name')}}
							<p class="form-control-static">{{$contactById->name}}</p>
						</div>
						<div class="form-group">
							{{Form::label('department', 'Department')}}
							<p class-"form-control-static">{{$contactById->department}}</p>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							{{Form::label('email', 'Email')}}
							<p class="form-control-static">{{$contactById->email}}</p>
						</div>
						<div class="form-group">
							{{Form::label('phone_no', 'Phone_no')}}
							<p class="form-control-static">{{$contactById->phone_no}}</p>
						
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group">
							{{Form::label('note', 'Message')}}
							<p class="form-control-static">{{$contactById->note}}</p>
						</div>
					</div>

					<hr>
					@if($replies->count())
					<div class="col-md-12">
						@foreach($replies as $reply)
						<div class="panel panel-default contact-reply-message">
							<div class="panel-heading">
								<small>Replied on <strong>{{date('d F Y',strtotime($reply->created_at))}}</strong> <i>at</i> <strong>{{date('h:iA',strtotime($reply->created_at))}}</strong></small>
							</div>
							<div class="panel-body">
								<pre>{{$reply->reply}}</pre>
							</div>
						</div>
						@endforeach
					</div>
					<hr>
					@endif

					<div class="col-md-10 col-md-offset-1">
						{{Form::open(array('url'=>route('contact.update', array($contactById->id)), 'method'=>'put'))}}
							<div class="form-group">
								{{Form::textarea('reply', '', array('placeholder'=>'Your Response', 'rows'=>'7', 'cols'=>'80', 'class'=>'input-sm form-control'))}}
								@if($errors->has('reply'))
								<p class="help-block"><span class="text-danger">{{$errors->first('reply')}}</span></p>
								@endif
							</div>	
							<div class="form-group text-right">
								{{Form::submit('Send', array('class'=>'btn btn-sm btn-primary'))}}
							</div>
						{{Form::close()}}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop