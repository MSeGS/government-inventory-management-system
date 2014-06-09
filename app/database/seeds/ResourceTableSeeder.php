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
			array('route'=>'home.ajax-admin', 'name'=>'Admin Home Ajax', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			
			array('route'=>'registration', 'name'=>'User Registration Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'registration.submit', 'name'=>'User Registration Submission', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'reset-password', 'name'=>'Reset Password Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'retrieve-username', 'name'=>'Retrieve Username Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'help.index', 'name'=>'Help List', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'help.create', 'name'=>'Help Create', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'help.edit', 'name'=>'Help Edit', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'help.destroy', 'name'=>'Help Destroy', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'help.update', 'name'=>'Help Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'help.store', 'name'=>'Help Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			
			array('route'=>'denied', 'name'=>'Access Denied Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'notfound', 'name'=>'Page Not Found', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'home.index', 'name'=>'Home Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			
			array('route'=>'product.index', 'name'=>'Product List/Create Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'product.edit', 'name'=>'Product Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'product.destroy', 'name'=>'Product Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'product.update', 'name'=>'Product Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'product.store', 'name'=>'Product Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'product.create', 'name'=>'Product Create', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'product.delete', 'name'=>'Product Force Delete', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'product.trash', 'name'=>'Product Trash', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

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
			array('route'=>'user.profile', 'name'=>'User Profile', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'user.profileUpdate', 'name'=>'User Profile Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			
			array('route'=>'damage.index', 'name'=>'Damage List', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.edit', 'name'=>'Damage Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.destroy', 'name'=>'Damage Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.update', 'name'=>'Damage Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.store', 'name'=>'Damage Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.trash', 'name'=>'Damage Trash', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.create', 'name'=>'Report Damage', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.manage', 'name'=>'Manage Damage', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.decline', 'name'=>'Damage Decline', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.delete', 'name'=>'Damage Force Delete', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'damage.restore', 'name'=>'Damage Restore', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'stock.index', 'name'=>'Stock List', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'stock.edit', 'name'=>'Stock Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'stock.destroy', 'name'=>'Stock Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'stock.update', 'name'=>'Stock Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'stock.store', 'name'=>'Stock Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'stock.create', 'name'=>'Stock Create', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'category.index', 'name'=>'Category List Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'category.edit', 'name'=>'Category Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'category.destroy', 'name'=>'Category Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'category.update', 'name'=>'Category Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'category.store', 'name'=>'Category Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'category.create', 'name'=>'Create Category', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

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

			array('route'=>'indent.index', 'name'=>'Indents List', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.edit', 'name'=>'Indent Edit Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.destroy', 'name'=>'Indent Remove', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.update', 'name'=>'Indent Update', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.store', 'name'=>'Indent Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.mine', 'name'=>'Indent List (Indentor)', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.show', 'name'=>'Indent Show', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.process', 'name'=>'Indent Process', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.postProcess', 'name'=>'Indent Process Submit', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.dispatch', 'name'=>'Indent Dispatch', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'indent.postDispatch', 'name'=>'Indent Dispatch Submit', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'message.index', 'name'=>'Message Index', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'message.read', 'name'=>'Message Read', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'message.outbox', 'name'=>'Message Outbox', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'message.create', 'name'=>'Message Compose', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'message.store', 'name'=>'Message Store', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'message.show', 'name'=>'Message ReadMore ', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'message.update', 'name'=>'Message Update ', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'report.product', 'name'=>'Product', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'report.user', 'name'=>'User', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'report.overview', 'name'=>'Overview', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'report.user-graphic', 'name'=>'Report User Graphic', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'report.user-detail', 'name'=>'Report User Details', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'report.product-detail', 'name'=>'Report Product Details', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'report.admin-ajax', 'name'=>'Report Ajax', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
		
			array('route'=>'contact-us', 'name'=>'Contact Form', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
		));
	}
}