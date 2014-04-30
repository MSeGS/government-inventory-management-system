<?php
class Requirement extends BaseStore
{
	
	protected $table = 'indent_requirements';


	public function __construct()
	{
		parent::__construct();
	}

	public function product()
	{
		return $this->belongsTo('Product');
	}
}