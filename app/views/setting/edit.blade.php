@extends('layout.main')

@section('content')
<div class="col-md-8">
	@if(Session::has('delete'))
	<div class="alert alert-danger">
		{{Session::get('delete')}}
	</div>
	@endif
	<div class="row">
		<table class="table table-striped  table-bordered">
			<thead>
				<tr>
					<th class="col-md-1">#</th>
					<th class="col-md-3"><?php echo _("Setting Name") ?></th>
					<th class="col-md-3"><?php echo _("Setting Value") ?></th>
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
						<?php if($currentSetting->id == $setting->id){ ?>
							<button href="{{route('setting.edit', array($setting->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="<?php echo _('Edit setting') ?>"><i class="fa fa-pencil"></i></button>
						<?php } else {?>
							<button href="{{route('setting.edit', array($setting->id))}}" class="btn btn-xs btn-success tooltip-top" title="<?php echo _('Edit setting') ?>"><i class="fa fa-pencil"></i></button>
						<?php } ?>
						<button type="submit" onclick="return confirm('<?php echo _('Are you sure') ?>');" name="id" class="btn btn-xs btn-danger tooltip-top" title="<?php echo _('Remove setting') ?>" value="{{$setting->id}}"><i class="fa fa-times"></i></button>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
		{{$settings->links()}}
</div>

<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center"><?php echo _("Edit Setting"); ?></h5></div>
		<div class="panel-body">
			{{Form::model($currentOption, array('url'=>route('setting.update', $currentOption->id), 'method'=>'put', 'class'=>'form-vertical'))}}

			@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}	
				</div>
			@endif

			<div class="form-group">
				<?php echo Form::label('option_key', _('Setting Name'), array('class'=>'control-label')); ?>
				<p class="form-control-static">{{Option::getTitle($currentSetting->option_key)}}</p>
			</div>

			<div class="form-group">
				<?php echo Form::label('option_data', _('Setting Value'), array('class'=>'control-label'))?>
				{{Form::textarea('option_data', Input::old('option_data', $currentSetting->option_data), array('class'=>'form-control input-sm','rows'=>'3'))}}
		
				@if($errors->has('option_data'))
				<p class="help-block"><span class="text-danger">{{$errors->first('option_data')}}</span></p>
				@endif
			</div>


			<div class="form-inline text-right">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
				</div>
				<div class="form-group">
					<button href="{{route('setting.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></button>
				</div>
			</div>	

			{{Form::close()}}
		</div>
	</div>
</div>
@stop