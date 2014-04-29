@extends('layout.main')

@section('content')
<div class="col-md-12">
	<div class="col-md-12">
		<div class="row">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="col-md-1">#</th>
						<th class="col-md-2"><?php echo _("From") ?></th>
						<th class="col-md-4"><?php echo _("Message") ?></th>
						<th class="col-md-2"><?php echo _("Received On") ?></th>
						<th class="col-md-1"><?php echo _("Status") ?></th>
						

					</tr>
				</thead>
				<tbody>
					<?php $i=0; ?>
					@foreach($notifications as $notification)
							<tr>
								<td>{{++$i}}</td>
								<td>{{($notification->sender->full_name != "")?$notification->sender->full_name:$notification->sender->username}}</td>
								<td>{{substr($notification->message,0,200)}}
									<?php
									if(strlen($notification->message)>200)
									{
									?>
									...<br><a class="pull-right" href="{{route('message.show', array($notification->id))}}">Read More</a>
									<?php
									}
									?>
										
</td>		
								<td>{{date('dS F, Y h:iA', strtotime($notification->read_at))}}</td>				
								<td>@if($notification->status == 'unread')
										{{Form::open(array('url'=>route('message.read', $notification->id), 'method'=>'put', 'style'=>'display:inline'))}}	
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