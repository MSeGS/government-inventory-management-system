<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndentRequirementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('indent_requirement', function(Blueprint $table)
		{
			$table -> increments('id');
			$table -> integer('indent_id');
			$table -> integer('product_id');
			$table -> smallInteger('quantity');
			$table -> enum('status', array('procured', 'pending'));
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
		Schema::drop('indent_requirement');
	}

}
