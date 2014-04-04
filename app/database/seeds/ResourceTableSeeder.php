<?php
class ResourceTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('resources')->truncate();

		DB::table('resources')->insert(array(
			array('route'=>'login', 'name'=>'Login Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'login.submit', 'name'=>'Login Submission', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'logout', 'name'=>'Logout', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			
			array('route'=>'registration', 'name'=>'User Registration Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'registration.submit', 'name'=>'User Registration Submission', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'help', 'name'=>'Help Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'reset-password', 'name'=>'Reset Password Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'retrieve-username', 'name'=>'Retrieve Username Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			
			array('route'=>'denied', 'name'=>'Access Denied Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'notfound', 'name'=>'Page Not Found', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'home.index', 'name'=>'Home Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			
			array('route'=>'category.index', 'name'=>'Category List/Create Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'category.edit', 'name'=>'Category Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'category.destroy', 'name'=>'Category Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'category.update', 'name'=>'Category Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'category.store', 'name'=>'Category Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'product.index', 'name'=>'Product List/Create Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'product.edit', 'name'=>'Product Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'product.destroy', 'name'=>'Product Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'product.update', 'name'=>'Product Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'product.store', 'name'=>'Product Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'setting.index', 'name'=>'Setting List/Create Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'setting.edit', 'name'=>'Setting Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'setting.destroy', 'name'=>'Setting Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'setting.update', 'name'=>'Setting Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'setting.store', 'name'=>'Setting Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'user.index', 'name'=>'User List/Create Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'user.edit', 'name'=>'User Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'user.destroy', 'name'=>'User Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'user.update', 'name'=>'User Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'user.store', 'name'=>'User Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			));
	}
}