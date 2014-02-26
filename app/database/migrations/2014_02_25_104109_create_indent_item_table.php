<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndentItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('indent_item', function(Blueprint $table)
		{	
			$table -> increments('id');
			$table -> integer('indent_id');
			$table -> integer('product_id');
			$table -> integer('quantity');
			$table -> text('indent_reason');
			$table -> text('reject_reason');
			$table -> timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('indent_item');
	}

}
