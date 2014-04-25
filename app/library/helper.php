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

	return ($total_stock - $total_damage) > 0?($total_stock - $total_damage):0;
}