@extends('layout.main')

@section('content')
<div class="col-md-8">
	@if(Session::has('delete'))
	<div class="alert alert-danger">
		{{Session::get('delete')}}
	</div>
	@endif
	<div class="col-mid-7">
		<table class="table table-striped  table-bordered">
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
						{{Form::open(array('url'=>route('setting.destroy', array($setting->id)), 'method'=>'delete'))}}
						@if($setting->id == $currentSetting->id)
							<a href="{{route('setting.edit', array($setting->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="Edit setting"><i class="fa fa-pencil"></i></a>
						@else
							<a href="{{route('setting.edit', array($setting->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit setting"><i class="fa fa-pencil"></i></a>
						@endif
						<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove setting" value="{{$setting->id}}"><i class="fa fa-times"></i></a>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$settings->links()}}
	</div>
</div>

<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center"><?php echo _("EDIT SETTING"); ?></h5></div>
		<div class="panel-body">
			@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}	
				</div>
			@endif

			{{Form::open(array('url'=>route('setting.update', array($currentSetting->id)), 'method'=>'put', 'class'=>'form-vertical'))}}

			<div class="form-group">
				<?php echo Form::label('option_key', _('Setting Name'), array('class'=>'control-label')); ?>
				<p class="form-control-static">{{Option::getTitle($currentSetting->option_key)}}</p>
			</div>

			<div class="form-group">
				<?php echo Form::label('option_data', _('Setting Value'), array('class'=>'control-label'))?>
				{{Form::textarea('option_data', Input::old('option_data', $setting->option_data), array('class'=>'form-control input-sm','rows'=>'3'))}}
		
				@if($errors->has('option_data'))
				<p class="help-block"><span class="text-danger">{{$errors->first('option_data')}}</span></p>
				@endif
			</div>


			<div class="form-inline text-right">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
				</div>
				<div class="form-group">
					<a href="{{route('setting.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
				</div>
			</div>	

			{{Form::close()}}
		</div>
	</div>
</div>
@stop