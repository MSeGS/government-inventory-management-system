@extends('layout.main')

@section('content')
<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-default" >
		<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Add Help');?></h5></div>
		<div class="panel-body">
			{{Form::open(array('url'=>route('help.store'),'method'=>'post','class'=>'form-vertical'))}}
				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}	
				</div>
				@endif

				<div class="form-group">
					<?php echo Form::label('group', _('Access Level'), array('class'=>'control-label')) ?>
					{{Form::select('group', $groups, 'null',array('class' =>'input-sm form-control'))}}
					@if($errors->has('group'))
					<p class="help-block"><span class="text-danger">{{$errors->first('group')}}</span></p>
					@endif
				</div>	

				<div class="form-group">
					<?php echo Form::label('title', _('Title'), array('class'=>'control-label')) ?>
					{{Form::text('title', '',array('class' =>'input-sm form-control'))}}
					@if($errors->has('title'))
					<p class="help-block"><span class="text-danger">{{$errors->first('title')}}</span></p>
					@endif
				</div>	
				
				<div class="form-group">
					<?php echo Form::label('body', _('Body'), array('class'=>'control-label')) ?>
					{{Form::textarea('body','',array('class' =>'input-sm form-control editor', 'id' =>'editor'))}}
					@if($errors->has('body'))
					<p class="help-block"><span class="text-danger">{{$errors->first('body')}}</span></p>
					@endif
				</div>	
				

				<div class="form-group text-right">
					<button type="submit" class="btn btn-sm btn-primary"><?php echo _('Submit');?></button>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop

@section('scripts')
<link rel="stylesheet" type="text/css" href="{{asset('templates/default/lib/redactor923/redactor.css')}}">
<script type="text/javascript" src="{{asset('templates/default/lib/redactor923/redactor.min.js')}}"></script>
<script type="text/javascript">
$(function(){
	$('#editor').redactor({
		focus: true,
		minHeight: 200,
	});
});
</script>
@stop