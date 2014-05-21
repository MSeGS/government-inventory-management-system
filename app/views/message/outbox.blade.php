@extends('layout.main')

@section('content')
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-2"><?php echo _("To") ?></th>
					<th class="col-md-4"><?php echo _("Message") ?></th>
					<th class="col-md-2"><?php echo _("Sent at") ?></th>
					<th class="col-md-2"><?php echo _("Status") ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; ?>
				@foreach($notifications as $notification)
						<tr>
							<td>{{++$i}}</td>
							<td>{{($notification->receiver->full_name != "")?$notification->receiver->full_name:$notification->receiver->username}}</td>
							<td>{{$notification->message}}</td>		
							<td>{{date('dS F, Y h:iA', strtotime($notification->created_at))}}</td>				
							<td>@if($notification->status == 'unread')
								<span class="label label-danger">
								@elseif($notification->status == 'read')
								<span class="label label-success fa-fa-check">
								@endif
									{{strtoupper($notification->status)}}
								</span>
							</td>
						</tr>
					@endforeach	
			</tbody>
		</table>
	</div>
	{{$notifications->appends(array('status'=>$filter['status']))->links()}}
</div>
	
@stop