@extends('layout.main')

@section('content')
<div class="col-md-10 col-md-offset-1">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="text-center">New Product</h5>
		</div>
		<div class="panel-body">

			{{Form::open(array('url'=>route('product.index'), 'method'=>'post', 'class'=>'form-vertical', 'autocomplete'=>'off'))}}				
				@if(Session::has('message'))
				<div class="alert alert-success">
					{{Session::get('message')}}
				</div>
				@endif

				<table class="add-product table table-hover">
					<thead>
						<tr>
							<th></th>
							<th class="col-sm-4"></th>
							<th class="col-sm-3"></th>
							<th class="col-sm-3"></th>
							<th class="col-sm-2"></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$total = Option::getData('no_items_to_create');
						$rows = range(0, $total);

						if(Session::has('items'))
							$rows = Session::get('items');
						?>
						@foreach($rows as $k=>$i)
						<tr id="prod_{{$i}}" class="{{$i==0?'hidden':''}}">
							<td><span class="badge badge-sm">{{$k}}</span></td>
							<td>
								<div class="form-group {{$errors->has('name.' . $i)?'has-error':''}}">
								<?php
								echo Form::text('name[' . $i . ']', 
									Input::old('name[' . $i . ']'), 
									array('title'=> ($errors->has('name.' . $i)?'Product name is required':''), 'class'=>'tooltip-top form-control input-sm', 'placeholder'=>_('Enter Product Name')));
								?>
								</div>
							</td>
							<td>
								<div class="form-group has-error">
								<?php
								echo Form::select('category[' . $i . ']', 
									$categories, 
									Input::old('category[' . $i . ']'), 
									array('class'=>'dropdown form-control input-sm'));
								?>
								</div>
							</td>
							<td><?php
							echo Form::text('description[' . $i . ']', 
								Input::old('description[' . $i . ']'), 
								array('class'=>'form-control input-sm', 'placeholder'=>_('Product description (Optional)')));
							?></td>
							<td>
								<div class="form-group {{$errors->has('reserved_amount.' . $i)?'has-error':''}}">
									<?php
									echo Form::text('reserved_amount[' . $i . ']', 
										Input::old('reserved_amount[' . $i . ']'), 
										array('title'=> ($errors->has('reserved_amount.' . $i)?_('Reserved amount is required and must be a number'):''), 'class'=>'tooltip-top form-control input-sm', 'placeholder'=>_('Reserved amount')));
									?>
								</div>
							</td>
							<td>
								<div class="form-group">
									{{Form::button('<i class="fa fa-times"></i>', array('class'=>'btn btn-xs btn-danger', 'onclick'=>'return removeRow(this)'))}}
								</div>
							</td>
						</tr>
						@endforeach

						<tr>
							<td class="text-center" colspan="6">
								<?php echo Form::button('<i class="fa fa-plus"></i> ' . _('More Row'), array('class'=>'btn btn-xs btn-success', 'onclick'=>'return addRow(this)'));?>
							</td>
						</tr>
					</tbody>
				</table>
				
				<div class="col-sm-12">
					<div class="row">
						<div class="form-group text-right">
							{{Form::submit('Submit', array("class"=>"btn btn-primary btn-sm"))}}
						</div>
					</div>
				</div>

			{{Form::close()}}
		</div>
	</div>
</div>

<script type="text/javascript">
function removeRow (button) {
	var row = $(button).closest('tr');
	row.fadeOut(400, function(){
		row.remove();
		var c = 0;
		$('.table tbody tr span.badge').each(function(){
			$(this).text(c++);
		});
	});
		
}

function addRow (button) {
	$('.dropdown').easyDropDown('destroy');
	$('.dropdown').removeAttr("id");
	var rows = $('.table tbody tr').size();	
	var new_row = $('.table tbody tr#prod_0').clone();
	var new_row_id = (rows-1);
	new_row = new_row.html().replace(/0/g, new_row_id);
	new_row = '<tr style="display:none" id="prod_' + new_row_id + '">' + new_row + '</tr>';
	$('.table tbody tr:last-child').before(new_row);
	$('.table tbody tr#prod_' + new_row_id).fadeIn(800);
	$('.table tbody tr#prod_' + new_row_id + ' input :first').focus();
	// $(window).scrollTop($(button).offset().top);
	initDropdown();
}
</script>
@stop