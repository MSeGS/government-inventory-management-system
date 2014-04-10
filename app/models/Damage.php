<?php
class Damage extends BaseStore
{
	
	protected $table = 'damages';
	

	public function __construct()
	{
		parent::__construct();
	}

	public function product()
	{
		return $this->belongsTo('Product');
	}

}