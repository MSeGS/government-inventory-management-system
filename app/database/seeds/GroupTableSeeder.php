<?php
class GroupTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('groups')->truncate();

		// Public Group
		try
		{
			$group = Sentry::createGroup(
				array(
				'name'        => 'Public',
				'permissions' => array(
					'login' => 1,
					'login.submit' => 1,
					'help' => 1,
					'registration' => 1,
					'registration.submit' => 1,
					'reset-password' => 1,
					'retrieve-username' => 1
				),
			));
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
			echo 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			echo 'Group already exists';
		}

		// Super Administrator Group
		try
		{
			$group = Sentry::createGroup(
				array(
				'name'        => 'Super Administrator',
				'permissions' => array(
					'superuser' => 1
				),
			));
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
			echo 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			echo 'Group already exists';
		}

		// Administrator Group
		try
		{
			$group = Sentry::createGroup(
				array(
				'name'        => 'Administrator',
				'permissions' => array(
					'home.index' => 1
				),
			));
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
			echo 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			echo 'Group already exists';
		}

		// Indentor Group
		try
		{
			$group = Sentry::createGroup(
				array(
				'name'        => 'Indentor',
				'permissions' => array(
					'home.index' => 1
				),
			));
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
			echo 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			echo 'Group already exists';
		}

		// Store Keeper Group
		try
		{
			$group = Sentry::createGroup(
				array(
				'name'        => 'Store Keeper',
				'permissions' => array(
					'home.index' => 1
				),
			));
		}
		catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
		{
			echo 'Name field is required';
		}
		catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
		{
			echo 'Group already exists';
		}

	}
}