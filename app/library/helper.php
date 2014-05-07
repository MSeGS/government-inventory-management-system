<?php
function get_product_by_category($category_id = 0)
{
	if(!$category_id)
		return null;
	else {
		return Product::where('category_id', '=', $category_id)
			->orderBy('name', 'asc')
			->get()
			->lists('id', 'name');
	}
}

function get_setting($setting_key, $default = null)
{
	$data = Option::getData($setting_key);
	if($data)
		return $data;
	else
		return $default;
}

function get_product_stock($product_id = null)
{
	if(!$product_id)
		return 0;

	$total_stock = Product::stock($product_id);
	$total_damage = Product::damage($product_id);
	$total_supplied = get_product_supplied($product_id);
	

	return ($total_stock - ($total_damage+$total_supplied)) > 0?($total_stock - ($total_damage+$total_supplied)):0;
}

function get_product_supplied($product_id = null)
{
	if($product_id == null)
		return 0;

	$indent = new Indent;
	$indent_item = new IndentItem;
	$indent_table = $indent->getTableName();
	$indent_item_table = $indent_item->getTableName();

	$item = IndentItem::join($indent_table, $indent_item_table . '.indent_id', '=', $indent_table . '.id')
				->whereIn($indent_table . '.status', array('dispatched','partial_dispatched'))
				->where($indent_item_table . '.status', '=', 'approved')
				->where('product_id', '=', $product_id)
				->select(array(DB::raw('SUM(supplied) as supplied')))
				->first();
	return (int)$item->supplied;
}

function get_unread_message_count()
{
	$user = Sentry:: getUser();
	if(!$user->isSuperUser()) {
		$count = Notification::where('receiver_id', '=', $user->id)
			->where('status', '=', 'unread')->count();
			
		return ($count > 0)?'<span class="badge">'.$count.'</span>':null;
	}
}

function get_current_user_id()
{
	$user = Sentry:: getUser();
	return $user->id;
}