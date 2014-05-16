<?php
class Damage extends BaseStore
{
	
	protected $table = 'damages';
	protected $softDelete = true;
	

	public function __construct()
	{
		parent::__construct();
	}

	public function product()
	{
		return $this->belongsTo('Product');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}
}