<?php
class Help extends Eloquent
{	
	protected $table = 'helps';

	public function groups()
	{
		return $this->belongsTo('Group','access_level','id');
	}

}
