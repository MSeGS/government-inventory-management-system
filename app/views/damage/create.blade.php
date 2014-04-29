@extends('layout.main')
@section('content')

<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default" >
		<div class="panel-heading" ><h5 class="text-center"> <?php echo _('Product Damage Report');?></h5></div>
			<div class="panel-body">
			{{Form::open(array('url'=>route('damage.store'),'method'=>'post','class'=>'form-vertical'))}}
				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}	
				</div>
				@endif

				<div class="form-group">
					<?php echo Form::label('category', _('Category'), array('class'=>'control-label')) ?>
					{{Form::select('category', $categorySelect, 'null',array('class' =>'input-sm form-control'))}}
					@if($errors->has('category'))
					<p class="help-block"><span class="text-danger">{{$errors->first('category')}}</span></p>
					@endif
				</div>	

				<div class="form-group">
					<?php echo Form::label('product', _('Product Name'), array('class'=>'control-label')) ?>
					{{Form::select('product', $productSelect, 'null',array('class' =>'input-sm form-control'))}}
					@if($errors->has('product'))
					<p class="help-block"><span class="text-danger">{{$errors->first('product')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('reported_at', _('Report Date'), array('class'=>'control-label')) ?>
					{{Form::text('reported_at', '',  array('class'=>'datepicker input-sm form-control', 'placeholder'=>'Pick a date'))}}
					@if($errors->has('reported_at'))
					<p class="help-block"><span class="text-danger">{{$errors->first('reported_at')}}</span></p>
					@endif
				</div>

				<div class="form-group">
					<?php echo Form::label('quantity', _('Quantity'), array('class'=>'control-label')) ?>
					{{Form::text('quantity', '',  array('class'=>'input-sm form-control'))}}
					@if($errors->has('quantity'))
					<p class="help-block"><span class="text-danger">{{$errors->first('quantity')}}</span></p>
					@endif
					
				</div>

				<div class="form-group">
					<?php echo Form::label('note', _('Note'), array('class'=>'control-label')) ?>
					{{Form::textarea('note', '', array('class'=>'input-sm form-control','rows'=>'2'))}}
					@if($errors->has('note'))
					<p class="help-block"><span class="text-danger">{{$errors->first('note')}}</span></p>
					@endif
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

@section('scripts')
<script type="text/javascript">
$(function(){
	populate_product();

	$('#category').on('change', function(){
		populate_product();
	});
});

function populate_product(status) {
	var html = '<option value="">Select Product</option>';
	if($('#category').val() != 0 && $('#category').val() != "") {
		
		$('#product').html('<option value="">Loading...</option>');

		$.get("{{route('product.index')}}?category=" + $('#category').val(), function(data){
			$.each(data, function(index, product){
				html += '<option value="'+product['id']+'">'+product['name']+'</option>';
			});
		})
		.done(function() {
			$('#product').html(html);
		});
	}
	else
		$('#product').html(html);

}
</script>
@stop
