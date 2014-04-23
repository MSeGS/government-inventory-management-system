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
			array('option_key'=>'item_per_page','option_title'=>'Item Per Page','option_data'=>'10'),
			array('option_key'=>'no_items_to_create','option_title'=>'Number of rows to generate for create page','option_data'=>'3'),

			));

	}

}