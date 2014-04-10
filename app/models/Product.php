<?php
class Product extends BaseStore
{
	
	protected $table = 'products';

	public function __construct()
	{
		parent::__construct();
	}

	public static function stock($product_id)
	{
		$stock = Stock::where('product_id', '=', $product_id)->pluck(DB::raw('SUM(`quantity`)'));
		return $stock;
	}

}