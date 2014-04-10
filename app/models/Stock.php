<?php
class Stock extends BaseStore
{
	
	protected $table = 'stocks';


	public function __construct()
	{
		parent::__construct();
	}

	public function product()
	{
		$product = $this->belongsTo('Product');
		return $product;
	}

}