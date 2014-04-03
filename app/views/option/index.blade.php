@extends('layout.main')


@section('content')

	<div class="col-md-8">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-3"><?php echo _("OPTION KEY") ?></th>
					<th class="col-md-3"><?php echo _("OPTION TITLE")?></th>
					<th class="col-md-3"><?php echo _("OPTION DATA") ?></th>
					<th class="col-md-2"></th>
				</tr>
			</thead>
			<tbody>
				<?php $i=0; ?>
				@foreach($options as $option)

				<tr>
					<td>{{++$i}}</td>
					<td>{{$option->option_key}}</td>
					<td>{{$option->option_title}}</td>
					<td>{{$option->option_data}}</td>
					<td>
						{{Form::open(array('url'=>'option/'.$option->id, 'method'=>'delete'))}}

						<a href="{{route('option.edit', array($option->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit option"><i class="fa fa-pencil"></i></a>
						<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove option" value="{{$option->id}}"><i class="fa fa-times"></i></a>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
			{{$options->links()}}
	</div>


<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center"><?php echo _("NEW OPTION") ?></h5></div>
		{{Form::open(array('url'=>'option', 'method'=>'post', 'class'=>'form-vertical'))}}

			@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}	
				</div>
			@endif
		<div class="panel-body">

			<div class="form-group">
				<?php echo Form::label('option_key', _('Option Key'), array('class'=>'control-label')) ?>
				{{Form::text('option_key', '', array('class'=>'form-control input-sm'))}}
				@if($errors->has('option_key'))
						<p class="help-block"><span class="text-danger">{{$errors->first('option_key')}}</span></p>
						@endif
			</div>

			<div class="form-group">
				<?php echo Form::label('option_title', _('Option Title'), array('class'=>'control-label'))?>
				{{Form::text('option_title', '', array('class'=>'form-control input-sm'))}}
				@if($errors->has('option_title'))
						<p class="help-block"><span class="text-danger">{{$errors->first('option_title')}}</span></p>
						@endif
			</div>

			<div class="form-group">
				<?php echo Form::label('option_data', _('Option Data'), array('class'=>'control-label'))?>
				{{Form::textarea('option_data', '', array('class'=>'form-control input-sm','rows'=>'3'))}}
				@if($errors->has('option_data'))
						<p class="help-block"><span class="text-danger">{{$errors->first('option_data')}}</span></p>
						@endif
			</div>

			
			<div class="form-group text-right">
				<button type="submit" name="submit" class="btn btn-primary btn-sm pull-right"><?php echo _('Submit') ?></button>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop