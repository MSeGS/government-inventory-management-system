<?php
class StoreDataTableSeeder extends Seeder
{
	public function run()
	{
		$sql = fopen(base_path('db/store1_import.sql'), 'r');
		DB::statement($sql);
	}
}