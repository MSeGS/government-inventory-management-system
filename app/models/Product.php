<?php
class Product extends BaseStore
{
	
	protected $table = 'products';
	protected $softDelete = true;

	public function __construct()
	{
		parent::__construct();
	}

	public static function stock($product_id, $year = null, $month = null)
	{
		$stock = Stock::where('product_id', '=', $product_id)
			->where(function($query){
					$year = Input::get('year');
					$month = Input::get('month');

					if($year != null && $month != null) {
						$query->where(DB::raw('MONTH(`created_at`)'), '=', $month);
						$query->where(DB::raw('YEAR(`created_at`)'), '=', $year);
					}
				})
			->pluck(DB::raw('SUM(`quantity`)'));
		return $stock?$stock:0;
	}

	public static function damage($product_id)
	{
		$damage = Damage::where('product_id', '=', $product_id)
			->where(function($query){
					$year = Input::get('year');
					$month = Input::get('month');

					if($year != null && $month != null) {
						$query->where(DB::raw('MONTH(`created_at`)'), '=', $month);
						$query->where(DB::raw('YEAR(`created_at`)'), '=', $year);
					}
				})
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

	public function items()
	{
		return $this->hasMany('IndentItem');
	}

	public static function updateInStock($product_id)
	{
		$in_stock = get_product_stock($product_id);
		Product::where('id','=',$product_id)->update(array('in_stock' => $in_stock));
	}
}