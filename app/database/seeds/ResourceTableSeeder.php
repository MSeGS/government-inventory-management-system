<?php
class ResourceTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('resources')->delete();

		DB::table('resources')->insert(array(
			array('route'=>'login', 'name'=>'Login Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'login.submit', 'name'=>'Login Submission', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'registration', 'name'=>'User Registration Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'registration.submit', 'name'=>'User Registration Submission', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'help', 'name'=>'Help Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'reset-password', 'name'=>'Reset Password Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'retrieve-username', 'name'=>'Retrieve Username Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			
			array('route'=>'denied', 'name'=>'Access Denied Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),
			array('route'=>'notfound', 'name'=>'Page Not Found', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()')),

			array('route'=>'home.index', 'name'=>'Home Page', 'created_at'=>DB::raw('NOW()'), 'updated_at'=>DB::raw('NOW()'))
			));
	}
}