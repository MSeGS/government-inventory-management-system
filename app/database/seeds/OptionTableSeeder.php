<?php

class OptionTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('options')->truncate();


		DB::table('options') -> insert(array(
			array('option_key'=>'site_title', 'option_title'=>'Site Title', 'option_data'=>'Indent Requisition System'),
			array('option_key'=>'item_per_page','option_title'=>'Item Per Page','option_data'=>'20'),

			));

	}

}