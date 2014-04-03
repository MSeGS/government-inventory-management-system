@extends('layout.main')

@section('content')
<div class="col-md-8">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th class="col-md-1">#</th>
				<th class="col-md-3"><?php echo _("SETTING NAME") ?></th>
				<th class="col-md-3"><?php echo _("SETTING VALUE") ?></th>
				<th class="col-md-1"></th>
			</tr>
		</thead>
		<tbody>
			<?php $i=0; ?>
			@foreach($settings as $setting)

			<tr>
				<td>{{++$i}}</td>
				<td>{{Option::getTitle($setting->option_key)}}</td>
				<td>{{$setting->option_data}}</td>
				<td>
					{{Form::open(array('url'=>'option/'.$setting->id, 'method'=>'delete'))}}

					<a href="{{route('option.edit', array($setting->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit option"><i class="fa fa-pencil"></i></a>
					{{Form::close()}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
		{{$settings->links()}}
</div>


<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center"><?php echo _("NEW OPTION") ?></h5></div>
			@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}	
				</div>
			@endif
		{{Form::open(array('url'=>'setting', 'method'=>'post', 'class'=>'form-vertical'))}}
		<div class="panel-body">	
			<div class="form-group">
				<?php echo Form::label('option_key', _('Option Key'), array('class'=>'control-label')) ?>
				{{Form::select('option_key', $optionSelect, 'null',array('class' =>'dropdown input-sm form-control'))}}
				@if($errors->has('option_key'))
						<p class="help-block"><span class="text-danger">{{$errors->first('option_key')}}</span></p>
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