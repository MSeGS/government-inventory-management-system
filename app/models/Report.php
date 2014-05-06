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

	
}