<div class="row">
	<div class="col-sm-1">
		{{Form::select('limit', array(10=>10, 30=>30, 40=>40, 50=>50, 100=>100, 150=>150, 200=>200), $filter['limit'], array('class' =>'dropdown input-sm form-control', 'onchange'=>'document.getElementById("indent_filter").submit()'))}}
	</div>

	<div class="col-md-2">
		<?php echo Form::select('status', $status, $filter['status'], array('class'=>'dropdown input-sm form-control'));?>
	</div>
	<div class="col-md-2">
		<?php echo Form::text('indent_date', $filter['indent_date'], array('class'=>'datepicker input-sm form-control','placeholder'=>_('Indent Date')));?>
	</div>
	<div class="col-md-3">
		<div class="input-group">
			<span class="input-group-addon">CHIT/</span>
			<?php echo Form::text('reference_no', $filter['reference_no'], array('class'=>'input-sm form-control','placeholder'=>_('Reference Number')));?>
			<span class="input-group-btn">
				<button class="btn-sm btn btn-default" name="search" value="Search" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
			</span>
		</div>
	</div>
</div>
