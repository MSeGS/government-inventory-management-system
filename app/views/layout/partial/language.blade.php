<p><strong>Languages</strong></p>
{{Form::open(array('url'=>url('lang'), 'method'=>'post'))}}

	{{Form::hidden('redirect_to', Request::url())}}
	<?php
	if(Cookie::get('lang') == 'mizo') {
		echo Form::button(_('English'), array(
			'name' => 'language',
			'value' => 'english',
			'class' => 'tooltip-bottom btn btn-primary btn-sm', 
			'title' => _('Switch language to English'),
			'data-toggle' => "tooltip",
			'type' => 'submit'
			));
		echo " ";
		echo Form::button('<i class="fa fa-check"></i> ' . _('Mizo'), array(
			'name' => 'language',
			'value' => 'mizo',
			'class' => 'tooltip-bottom btn btn-success btn-sm', 
			'title' => _('Current system language'),
			'data-toggle' => "tooltip",
			'type' => 'submit'
			));
	}
	else {
		echo Form::button('<i class="fa fa-check"></i> ' . _('English'), array(
			'name' => 'language',
			'value' => 'english',
			'class' => 'tooltip-bottom btn btn-success btn-sm', 
			'title' => _('Current system language'),
			'data-toggle' => "tooltip",
			'type' => 'submit'
			));
		echo " ";
		echo Form::button(_('Mizo'), array(
			'name' => 'language',
			'value' => 'mizo',
			'class' => 'tooltip-bottom btn btn-primary btn-sm', 
			'title' => _('Switch language to Mizo'),
			'data-toggle' => "tooltip",
			'type' => 'submit'
			));
	}

	?>
{{Form::close()}}