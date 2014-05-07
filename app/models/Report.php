<?php
class Report extends BaseStore
{

	public static function user($store)
	{
		$users = User::with(array('indents', 'indents.requirements'))
			->where('store_id', '=', $store)
			->get();

		return $users;
	}


	public static function requirement($product_id)
	{
		$requirement = Requirement::where('product_id', '=', $product_id)
									->where('status', '=', 'approved')
									->pluck(DB::raw('SUM(`quantity`)'));
		return $requirement?$requirement:0;
	}

	public static function dispatched($product_id)
	{
		$indent = new Indent;
		$indent_item = new IndentItem;
		$indent_table = $indent->getTableName();
		$indent_item_table = $indent_item->getTableName();

		$indent = IndentItem::join($indent_table, $indent_item_table . '.indent_id', '=', $indent_table . '.id')
				->whereIn($indent_table . '.status', array('dispatched','partial_dispatched'))
				->where($indent_item_table . '.status', '=', 'approved')
				->where('product_id', '=', $product_id)
				->pluck((DB::raw('SUM(supplied)')));

		return (int)$indent?$indent:0;
		
	}

	public static function damaged($product_id)
	{
		$damage = Damage::where('product_id', '=', $product_id)
									->where('status', '=', 'approved')
									->pluck(DB::raw('SUM(`quantity`)'));
		return (int)$damage?$damage:0;
	}
}