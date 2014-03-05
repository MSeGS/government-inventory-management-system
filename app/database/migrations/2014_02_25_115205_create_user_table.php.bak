<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 100);
			$table->string('full_name', 250);
			$table->string('password', 200);
			$table->string('reset_password_token', 300);
			$table->datetime('reset_password_token_expiry_at');
			$table->string('salt', 200);
			$table->enum('role', array('super_administrator', 'administrator', 'store_keeper', 'indentor'));
			$table->enum('status', array('active', 'inactive'));
			$table->string('email_id',100);
			$table->string('phone_no', 250);
			$table->text('address');
			$table->integer('department_id');
			$table->string('designation', 250);
			$table->datetime('last_login_at');
			$table->timestamps();
			$table->integer('store_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user');
	}

}
