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
			array('route'=>'product.create', 'name'=>'Product Create', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

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

			array('route'=>'stock.index', 'name'=>'Stock List/Create Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'stock.edit', 'name'=>'Stock Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'stock.destroy', 'name'=>'Stock Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'stock.update', 'name'=>'Stock Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'stock.store', 'name'=>'Stock Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			
			array('route'=>'damage.index', 'name'=>'Damage List', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.edit', 'name'=>'Damage Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.destroy', 'name'=>'Damage Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.update', 'name'=>'Damage Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.store', 'name'=>'Damage Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.trash', 'name'=>'Damage Trash', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.create', 'name'=>'Report Damage', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.manage', 'name'=>'Manage Damage', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'option.index', 'name'=>'Option List/Create Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'option.edit', 'name'=>'Option Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'option.destroy', 'name'=>'Option Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'option.update', 'name'=>'Option Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'option.store', 'name'=>'Option Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'department.index', 'name'=>'Department List/Create Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'department.edit', 'name'=>'Department Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'department.destroy', 'name'=>'Department Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'department.update', 'name'=>'Department Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'department.store', 'name'=>'Department Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'group.index', 'name'=>'Group List/Create Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'group.edit', 'name'=>'Group Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'group.destroy', 'name'=>'Group Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'group.update', 'name'=>'Group Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'group.store', 'name'=>'Group Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'group.permission', 'name'=>'Group Permission', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'group.updatePermission', 'name'=>'Group Permission Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'store.index', 'name'=>'Store List/Create Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'store.edit', 'name'=>'Store Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'store.destroy', 'name'=>'Store Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'store.update', 'name'=>'Store Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'store.store', 'name'=>'Store Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'indent.index', 'name'=>'Indent List/Create Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.edit', 'name'=>'Indent Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.destroy', 'name'=>'Indent Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.update', 'name'=>'Indent Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.store', 'name'=>'Indent Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'message.index', 'name'=>'Message Index', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'message.read', 'name'=>'', 'Message Read'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'message.outbox', 'name'=>'Message Outbox', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			));
	}
}