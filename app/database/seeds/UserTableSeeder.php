<?php
class UserTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('users')->delete();

		try
		{
		    // Create the user
		    $user = Sentry::createUser(array(
		        'username'  => 'super',
		        'password'  => 'pass',
		        'activated' => true,
		    ));

		    // Find the group using the group name
		    $superGroup = Sentry::findGroupByName('Super Administrator');
		    $publicGroup = Sentry::findGroupByName('Public');

		    // Assign the group to the user
		    $user->addGroup($superGroup);
		    $user->addGroup($publicGroup);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    echo 'User with this login already exists.';
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group was not found.';
		}
	}
}