@extends('layout.main')

@section('content')
<div class="col-md-12">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12 pull-right text-right" style= 'padding-right:0px'>
				<a href="{{route('message.create')}}" class="btn btn-primary btn-sm" ><?php echo _("Outbox") ?></a>
			</div>
		</div>
		<br>
	</div>

	<div class="col-md-12">
		<div class="row">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-md-1">#</th>
						<th class="col-md-2"><?php echo _("From") ?></th>
						<th class="col-md-4"><?php echo _("Message") ?></th>
						<th class="col-md-2"><?php echo _("Received On") ?></th>
						<th class="col-md-2"><?php echo _("Status") ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $i=0; ?>
					@foreach($notifications as $notification)
							<tr>
								<td>{{++$i}}</td>
								<td>{{($notification->sender->full_name != "")?$notification->sender->full_name:$notification->sender->username}}</td>
								<td>{{$notification->message}}</td>		
								<td>{{date('dS F, Y h:iA', strtotime($notification->read_at))}}</td>				
								<td>@if($notification->status == 'unread')
										{{Form::open(array('url'=>route('message.read', $notification->id), 'method'=>'post', 'style'=>'display:inline'))}}	
										{{Form::button('<i class="fa fa-check"></i> Mark as Read', array('value'=>$notification->id, 'type'=>'submit', 'name'=>'id', 'class'=>'btn btn-xs btn-success'))}}
										{{Form::close()}}
									@elseif($notification->status == 'read')
										<span class="text-success">{{ucwords($notification->status)}}</span>
									@endif
									</span>
								</td>
							</tr>
						@endforeach	
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop