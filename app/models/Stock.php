<?php
class Stock extends BaseStore
{
	
	protected $table = 'stocks';
	protected $softDelete = true;


	public function __construct()
	{
		parent::__construct();
	}

	public function product()
	{
		$product = $this->belongsTo('Product');
		return $product;
	}

	public function category()
	{
		return $this->belongsTo('Category');
	}

}
