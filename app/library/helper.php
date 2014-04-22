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