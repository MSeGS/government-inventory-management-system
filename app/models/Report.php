<?php
class Report extends BaseStore
{

	public static function user($store)
	{
		$users = User::with(array('indents', 'indents.requirements','damages'))
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

	public static function groupCount($current_user)
	{
		return DB::Select(DB::Raw("SELECT 
				( SELECT COUNT(*) FROM 
					(SELECT `user_id` FROM `users_groups` WHERE `group_id` = 3 AND `user_id` IN 
						( SELECT `id` FROM `users` WHERE `store_id` = ".$current_user->store_id." ) ) 
					as admins 
				)
				AS adminsCount,
				( SELECT COUNT(*) FROM 
					(SELECT DISTINCT `user_id` FROM `users_groups` WHERE `group_id` = 4 AND `user_id` IN 
						( SELECT `id` FROM `users` WHERE `store_id` = ".$current_user->store_id." ) ) 
					as storekeepers 
				)
				AS storeKeepersCount,
				( SELECT COUNT(*) FROM 
					(SELECT `user_id` FROM `users_groups` WHERE `group_id` = 5 AND `user_id` IN
						(SELECT `id` FROM `users` WHERE `store_id`= ".$current_user->store_id.")) 
					as indentors
				) 
				AS indentorsCount"
				)
		);
	}

	public static function getUserIndents( $year )
	{
		$indents = Indent::where(DB::Raw('YEAR(`indent_date`)'),'=',$year)->orderBy('indent_date')->get();
		
		return $indents;
	}
}