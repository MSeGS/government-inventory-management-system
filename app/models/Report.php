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

	public static function store($store_id = null)
	{
		$report = array(
			'product' => 0,
			'indent' => 0,
			'requirement' => 0,
			'administrator' => 0,
			'store_keeper' => 0,
			'indentor' => 0,
			);

		$store = Store::find($store_id);
		if($store) {
			$report['product'] = sizeof(DB::table('store' . $store->id . '_products')->select('id')->get());
			$report['indent'] = sizeof(DB::table('store' . $store->id . '_indents')->select('id')->get());
			$report['requirement'] = sizeof(DB::table('store' . $store->id . '_indent_requirements')->select('id')->get());

			$user_model = new User;
			$user_table = $user_model->getTable();

			$administrator = User::where(function($query){
				$user_group_model = new UserGroup;
				$user_group_table = $user_group_model->getTable();
				$group_model = new Group;
				$group_table = $group_model->getTable();
				$users = UserGroup::join($group_table, $user_group_table.'.group_id', '=', $group_table.'.id')
					->where('name', '=', 'Administrator')->lists('user_id');
					$query->whereIn('id', $users);
				})
				->where('store_id', '=', $store->id)
				->get();
			$report['administrator'] = sizeof($administrator);

			$storekeeper = User::where(function($query){
				$user_group_model = new UserGroup;
				$user_group_table = $user_group_model->getTable();
				$group_model = new Group;
				$group_table = $group_model->getTable();
				$users = UserGroup::join($group_table, $user_group_table.'.group_id', '=', $group_table.'.id')
					->where('name', '=', 'Storekeeper')->lists('user_id');
					$query->whereIn('id', $users);
				})
				->where('store_id', '=', $store->id)
				->get();
			$report['storekeeper'] = sizeof($storekeeper);

			$indentor = User::where(function($query){
				$user_group_model = new UserGroup;
				$user_group_table = $user_group_model->getTable();
				$group_model = new Group;
				$group_table = $group_model->getTable();
				$users = UserGroup::join($group_table, $user_group_table.'.group_id', '=', $group_table.'.id')
					->where('name', '=', 'Indentor')->lists('user_id');
					$query->whereIn('id', $users);
				})
				->where('store_id', '=', $store->id)
				->get();
			$report['indentor'] = sizeof($indentor);
		}

		return $report;
	}
}