@extends('layout.main')

@section('content')



<div class="row align-scenter">
	 <div class="col-md-2"> &nbsp;</div>
		<div class="col-md-8">
			<div class="panel panel-default" >
				<div class="panel-heading" ><h5 class="text-center">Message Inbox</h5></div>
					<div class="panel-body">
								<strong>From : {{$currentMessage->sender->full_name}},</strong>
								<br><br>
								{{$currentMessage->message}}
								<br><br>
								Received on : {{$currentMessage->created_at}}
					</div>
				</div>
			</div>
		</div>
	 <div class="col-md-2"> &nbsp;</div>

	<div class="col-md-8">
		<div class="col-md-6 pull-right text-right" style='padding-right:0px'>
			<a href="{{route('message.index')}}" class="btn btn-primary btn-sm" ><?php echo _("Back to Inbox") ?></a>
		</div>
	</div>
</div>
@stop