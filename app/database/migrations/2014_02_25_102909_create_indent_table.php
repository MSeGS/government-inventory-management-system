<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('indent', function(Blueprint $table)
		{	
			$table -> increments('id');
			$table -> integer('indentor_id');
			$table -> datetime('indent_date');
			$table -> enum('status', array('pending_approval','approved', 'partial_dispatched', 'dispatched', 'rejected'));
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
		Schema::drop('indent');
	}

}
