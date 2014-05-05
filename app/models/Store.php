<?php
class Store extends Eloquent
{
	protected $table = 'stores';
	
	public function department()
	{
		return $this->hasOne('Department', 'id', 'department_id');
	}

	public function prepareDbTables($store_id)
	{
		$store_prefix = 'store' . $store_id . '_';

		// Create indents table
		if(!Schema::hasTable($store_prefix . 'indents')) {
			Schema::create($store_prefix . 'indents', function($table)
			{	
				$table->increments('id');
				$table->string('reference_no')->nullable();
				$table->integer('indentor_id');
				$table->datetime('indent_date');
				$table->enum('status', array('pending_approval','approved', 'partial_dispatched', 'dispatched', 'rejected'))->default('pending_approval');
				
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDb';
			});
		}

		// Create indent items table
		if(!Schema::hasTable($store_prefix . 'indents_items')) {
			Schema::create($store_prefix . 'indents_items', function($table)
			{	
				$table->increments('id');
				$table->integer('indent_id');
				$table->integer('product_id');
				$table->integer('quantity');
				$table->integer('supplied')->default(0);
				$table->enum('status', array('pending', 'approved', 'rejected'))->default('pending');
				$table->text('indent_reason')->nullable();
				$table->text('reject_reason')->nullable();
				
				$table->timestamps();
				
				$table->engine = 'InnoDb';
			});
		}

		// Create requirements table
		if(!Schema::hasTable($store_prefix . 'indent_requirements')) {
			Schema::create($store_prefix . 'indent_requirements', function($table)
			{
				$table->increments('id');
				$table->integer('indent_id');
				$table->integer('product_id');
				$table->smallInteger('quantity');
				$table->enum('status', array('procured', 'approved', 'pending', 'rejected'))->default('pending');
				$table->text('reason')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDb';
			});
		}

		// Create notifications table
		if(!Schema::hasTable($store_prefix . 'notifications')) {
			Schema::create($store_prefix . 'notifications', function($table)
			{
				$table->increments('id');
				$table->integer('sender_id');
				$table->integer('receiver_id');
				$table->text('message');
				$table->datetime('read_at');
				$table->enum('status', array('unread', 'read'));
				
				$table->timestamps();
				$table->softDeletes();

				$table->engine = 'InnoDb';
			});
		}

		// Create products table
		if(!Schema::hasTable($store_prefix . 'products')) {
			Schema::create($store_prefix . 'products', function($table)
			{
				$table->increments('id');
				$table->integer('category_id');
				$table->string('name', 300);
				$table->text('description');
				$table->integer('reserved_amount');
				
				$table->timestamps();
				$table->softDeletes();
				
				$table->engine = 'InnoDb';
			});
		}

		// Create categories table
		if(!Schema::hasTable($store_prefix . 'categories')) {
			Schema::create($store_prefix . 'categories', function($table)
			{
				$table->increments('id');
				$table->string('category_name');
				
				$table->timestamps();
				$table->softDeletes();
				
				$table->engine = 'InnoDb';
			});

			DB::table($store_prefix . 'categories') -> insert(array(
				array('category_name' => 'Uncategorized', 'created_at'=>DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()'))
			));
		}

		// Create damages table
		if(!Schema::hasTable($store_prefix . 'damages')) {
			Schema::create($store_prefix . 'damages', function($table)
			{
				$table->increments('id');
				$table->integer('product_id');
				$table->smallInteger('quantity');
				$table->integer('user_id');
				$table->enum('status', array('approved', 'pending', 'declined'));
				$table->text('note');
				$table->datetime('reported_at');
				$table->timestamps();
				$table->softDeletes();
				
				$table->engine = 'InnoDb';
			});
		}

		// Create stocks table
		if(!Schema::hasTable($store_prefix . 'stocks')) {
			Schema::create($store_prefix . 'stocks', function($table)
			{
				$table->increments('id');
				$table->integer('category_id');
				$table->integer('product_id');
				$table->integer('quantity');
				$table->string('note');
				$table->integer('user_id');
				
				$table->timestamps();
				$table->softDeletes();
				
				$table->engine = 'InnoDb';
			});
		}

		// Create options table
		if(!Schema::hasTable($store_prefix . 'options')) {
			Schema::create($store_prefix . 'options', function($table)
			{
				$table->increments('id');
				$table->text('option_key');
				$table->text('option_data')->nullable();
				
				$table->engine = 'InnoDb';
			});
		}
	}

	public function dropDbTables($store_id)
	{
		$store_prefix = 'store' . $store_id . '_';

		// Drop indents table
		Schema::dropIfExists($store_prefix . 'indents');

		// Drop indent items table
		Schema::dropIfExists($store_prefix . 'indent_items');

		// Drop requirements table
		Schema::dropIfExists($store_prefix . 'indent_requirements');

		// Drop notifications table
		Schema::dropIfExists($store_prefix . 'notifications');

		// Drop products table
		Schema::dropIfExists($store_prefix . 'products');

		// Drop categories table
		Schema::dropIfExists($store_prefix . 'categories');

		// Create damages table
		Schema::dropIfExists($store_prefix . 'damages');

		// Create stocks table
		Schema::dropIfExists($store_prefix . 'stocks');

		// Create stocks table
		Schema::dropIfExists($store_prefix . 'options');
	}
}