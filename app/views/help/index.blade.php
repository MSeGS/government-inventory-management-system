@extends('layout.main')

@section('contentTop')
@if($current_user->hasAccess('help.create'))
<div class="col-md-10 col-md-offset-1 text-right">
	<div class="row">
		<a href="{{$current_user->hasAccess('help.index')?route('help.create'):route('help.index')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> <?php echo _('Add help'); ?></a>
	</div>
</div>
@endif
@stop

@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
			@if(Session::has('delete'))
			<div class="alert alert-danger">
			{{Session::get('delete')}}	
			</div>
			@endif
			
			<?php $i=1; ?>
			<table class="table">
				<tbody>
					@foreach($helps as $help)
					<tr>
						<td>
							<h4 class="help-title">
								{{$i++}}. {{$help->title}}
								<span class="pull-right">
									{{Form::open(array('url'=>route('help.destroy', array($help->id)),'method'=>'delete'))}}
									@if($current_user->hasAccess('help.create'))
									<a href="{{route('help.edit', array($help->id, ))}}" class="btn btn-xs btn-success tooltip-top" title="Edit help"><i class="fa fa-pencil"></i></a>
									<button type="submit" onclick="return confirm('<?php echo _('Are you sure') ?>');" name="id" class="btn btn-xs btn-danger tooltip-top" title="<?php echo _('Remove help')?>" value="{{$help->id}}"><i class="fa fa-times"></i></button>
									@endif
									{{Form::close()}}	
								</span>
							</h4>
							<div class="col-md-12 help-body">
								<div class="row">{{$help->body}}</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>		
	</div>
</div>
@stop