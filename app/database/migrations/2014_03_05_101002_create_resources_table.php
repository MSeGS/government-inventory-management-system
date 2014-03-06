<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resources', function($table){
			$table->increments('id');
			$table->string('route');
			$table->string('name');
			$table->timestamps();
			$table->softDeletes();

			$table->engine = 'InnoDb';
			$table->unique('route');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('resources');
	}

}
