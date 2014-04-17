@extends('layout.main')
@section('content')

<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default" >
		<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Product Damage Report');?></h5></div>
			<div class="panel-body">
			{{Form::open(array('url'=>route('damage.store'),'method'=>'post','class'=>'form-vertical'))}}

				<div class="form-group">
					<?php echo Form::label('category', _('Category'), array('class'=>'control-label')) ?>
					{{Form::select('category', $categorySelect, 'null',array('class' =>'dropdown input-sm form-control'))}}
					
				</div>	

				<div class="form-group">
					<?php echo Form::label('product', _('Product Name'), array('class'=>'control-label')) ?>
					{{Form::select('product', $productSelect, 'null',array('class' =>'dropdown input-sm form-control'))}}
				</div>

				<div class="form-group">
					<?php echo Form::label('reported_at', _('Report Date'), array('class'=>'control-label')) ?>
					{{Form::text('reported_at', '',  array('class'=>'datepicker input-sm form-control', 'placeholder'=>'Pick a date'))}}
				</div>

				<div class="form-group">
					<?php echo Form::label('quantity', _('Quantity'), array('class'=>'control-label')) ?>
					{{Form::text('quantity', '',  array('class'=>'input-sm form-control'))}}
					
				</div>

				<div class="form-group">
					<?php echo Form::label('note', _('Note'), array('class'=>'control-label')) ?>
					{{Form::textarea('note', '', array('class'=>'input-sm form-control','rows'=>'2'))}}
					
				</div>

				<div class="form-group text-right">
					<button type="submit" class="btn btn-sm btn-primary"><?php echo _('Submit');?></button>
				</div>
			{{Form::close()}}
			</div>
		</div>
	</div>
</div>
@stop

