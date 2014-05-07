<?php
class Product extends BaseStore
{
	
	protected $table = 'products';
	protected $softDelete = true;

	public function __construct()
	{
		parent::__construct();
	}

	public static function stock($product_id)
	{
		$stock = Stock::where('product_id', '=', $product_id)->pluck(DB::raw('SUM(`quantity`)'));
		return $stock?$stock:0;
	}

	public static function damage($product_id)
	{
		$damage = Damage::where('product_id', '=', $product_id)
			->where('status', '=', 'approved')
			->pluck(DB::raw('SUM(`quantity`)'));
		return $damage?$damage:0;
	}

	public function indent()
	{
		return $this->hasMany('IndentItem', 'product_id', 'id');
	}

	public function requirement()
	{
		return $this->hasMany('Requirement', 'product_id', 'id');
	}

	public function category()
	{
		return $this->belongsTo('Category');
	}

}