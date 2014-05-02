<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone_no');
			$table->string('department');
			$table->string('note');
			$table->string('mail_text');
			$table->enum('status', array('read', 'unread', 'replied'));
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('contacts');
	}

}