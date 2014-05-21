<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndRenameFieldsToSentryUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->dropColumn('email');

			$table->string('username')->after('id');
			$table->string('full_name')->after('username')->nullable();

			$table->integer('store_id')->after('full_name')->default(0);
			$table->string('email_id', 255)->after('store_id');
			$table->string('phone_no', 250)->after('email_id')->nullable();
			$table->text('address')->after('phone_no')->nullable();
			$table->integer('department_id')->after('address')->nullable();
			$table->string('designation', 250)->after('department_id')->nullable();

			$table->unique('username');
			$table->unique('email_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
		    $table->dropColumn('email_id');
			$table->dropColumn('username');
			$table->dropColumn('full_name');
			$table->dropColumn('store_id');
			$table->dropColumn('phone_no');
			$table->dropColumn('address');
			$table->dropColumn('department_id');
			$table->dropColumn('designation');

			$table->string('email')->after('id');

			$table->unique('email');
		});
	}

}
