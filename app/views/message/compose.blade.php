@extends('layout.main')

@section('content')
<div class="row align-scenter">
	 <div class="col-md-3"> &nbsp;</div>
			<div class="col-md-6">
				<div class="panel panel-default" >
					<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Compose Message');?></h5></div>
						<div class="panel-body">

							@if(Session::has('message'))
							<div class="alert alert-success">
								{{Session::get('message')}}	
							</div>
							@endif

							{{Form::open(array('url'=>route('message.store'),'method'=>'post','class'=>'form-vertical'))}}

							 {{Form::hidden('sender_id',$userid)}}
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
									<a href="{{route('message.index')}}" class="btn btn-primary btn-sm" ><?php echo _("Back to Inbox") ?></a>
								</div>
							{{Form::close()}}
						</div>
					</div>
			</div>
		</div>
 	<div class="col-md-3"> &nbsp;</div>
 </div>
@stop