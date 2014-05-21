<?php
class StoreTableSeeder extends Seeder
{
	public function run()
	{
		$store = new Store;
		$store->department_id = 1;
		$store->store_code = 'ATI';
		$store->save();

		$store->prepareDbTables($store->id);
	}
}