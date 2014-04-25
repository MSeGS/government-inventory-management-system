@extends('layout.main')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="col-md-6 pull-right text-right" style='padding-right:0px'>
			<a href="{{route('message.index')}}" class="btn btn-primary btn-sm" ><?php echo _("Inbox") ?></a>
		</div>
	</div>
</div>
<br>
	<div class="row">
		<div class="col-md-8">
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
	

	<div class="col-md-4">
		<div class="panel panel-default" >
			<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Compose Message');?></h5></div>
				<div class="panel-body">

					@if(Session::has('message'))
					<div class="alert alert-success">
						{{Session::get('message')}}	
					</div>
					@endif

					{{Form::open(array('url'=>route('message.store'),'method'=>'post','class'=>'form-vertical'))}}

					 {{Form::hidden('sender_id',$currentUser)}}
						<div class="form-group">
							<?php echo Form::label('receiver_id', _('To'), array('class'=>'control-label')); ?>
							{{Form::select('receiver_id', $userSelect, '', array('class'=>'dropdown input-sm form-control'))}}
						</div>	

						<div class="form-group">
							<?php echo Form::label('message', _('Message'), array('class'=>'control-label')); ?>
							{{Form::textarea('message', '', array('class'=>'input-sm form-control','rows'=>'4'))}}
							@if($errors->has('message'))
							<p class="help-block"><span class="text-danger">{{$errors->first('message')}}</span></p>
							@endif
						</div>

						<div class="form-group text-right">
							<button type="submit" class="btn btn-sm btn-primary"><?php echo _('Sent');?></button>
						</div>
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
@stop