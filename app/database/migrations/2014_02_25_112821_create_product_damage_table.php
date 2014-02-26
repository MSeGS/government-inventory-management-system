<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDamageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_damage', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> integer('product_id');
			$table -> smallInteger('quantity');
			$table -> integer('user_id');
			$table -> enum('status', array('approved', 'pending', 'declined'));
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
		Schema::drop('product_damage');
	}

}
