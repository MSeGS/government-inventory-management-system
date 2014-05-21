@extends('layout.main')

@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading"><h5 class="text-center"><?php echo _("Store Setting") ?></h5></div>
			<div class="panel-body">
				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}	
				</div>
				@endif

				{{Form::open(array('url'=>'setting', 'method'=>'post', 'class'=>'form-vertical'))}}

				@foreach($options as $option)
				<div class="form-group">
					<?php echo Form::label($option->option_key, _(Option::getTitle($option->option_key)), array('class'=>'control-label')) ?>
					{{Form::textarea($option->option_key, Input::old($option->option_key, Option::getData($option->option_key)), array('class'=>'form-control input-sm','rows'=>'1', 'id' => $option->option_key))}}

					@if($errors->has($option->option_key))
					<p class="help-block"><span class="text-danger"><?php echo _('This field is required.'); ?></span></p>
					@endif
				</div>
				@endforeach
				
				
				<div class="form-group text-right">
					<button type="submit" name="submit" class="btn btn-primary btn-sm pull-right"><?php echo _('Save') ?></button>
				</div>
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>
@stop