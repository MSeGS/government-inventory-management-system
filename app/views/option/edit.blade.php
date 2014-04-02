@extends('layout.main')

@section('content')
<div class="col-md-8">
	<table class="table table-striped  table-bordered">
		<thead>
			<tr>
				<th class="col-md-1">#</th>
				<th class="col-md-3"><?php echo _("OPTION KEY") ?></th>
				<th class="col-md-3"><?php echo _("OPTION TITLE") ?></th>
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
					<?php if($option->id == $optionById->id){ ?>
						<a href="{{route('option.edit', array($option->id))}}" class="btn btn-xs btn-success tooltip-top disabled" title="Edit option"><i class="fa fa-pencil"></i></a>
					<?php } else { ?>
						<a href="{{route('option.edit', array($option->id))}}" class="btn btn-xs btn-success tooltip-top" title="Edit option"><i class="fa fa-pencil"></i></a>
					<?php } ?>
					<button type="submit" onclick="return confirm('Are you sure');" name="id" class="btn btn-xs btn-danger tooltip-top" title="Remove option" value="{{$option->id}}"><i class="fa fa-times"></i></a>
					{{Form::close()}}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	
</div>
<div class="col-md-4">
	<div class="panel panel-default">
		<div class="panel-heading"><h5 class="text-center"><?php echo _("EDIT OPTION") ?></h5></div>
		<div class="panel-body">
			{{Form::model($optionById, array('url'=>'option/'.$optionById->id, 'method'=>'put', 'class'=>'form-vertical'))}}

			<div class="form-group">
				<?php echo Form::label('option_key', _('Option Key'), array('class'=>'control-label'))?>
				{{Form::text('option_key', Input::old('option_key'), array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-group">
				<?php echo Form::label('option_title', _('Option Title'), array('class'=>'control-label'))?>
				{{Form::text('option_title', Input::old('option_data'), array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-group">
				<?php echo Form::label('option_data', 'Option Data', array('class'=>'control-label'))?>
				{{Form::text('option_data', Input::old('option_data'), array('class'=>'form-control input-sm'))}}
			</div>

			<div class="form-inline text-right">
				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-primary btn-sm"><?php echo _('Save'); ?></button>
				</div>
				<div class="form-group">
					<a href="{{route('option.index')}}"><span class="btn btn-primary btn-sm"><?php echo _('Cancel');?></span></a>
				</div>
			</div>	

			{{Form::close()}}
		</div>
	</div>
</div>
@stop