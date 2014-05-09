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
					'retrieve-username' => 1,
					'contact-us' => 1,
					'denied' => 1,
					'notfound' => 1,
					'logout' => 1,
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
					'denied' => 1,
					'notfound' => 1,
					'home.index' => 1,
					'category.create' => 1,
					'category.index' => 1,
					'category.edit' => 1,
					'category.store' => 1,
					'category.update' => 1,
					'category.destroy' => 1,
					'damage.manage' => 1,
					'damage.approve' => 1,
					'damage.decline' => 1,
					'login' => 1,
					'login.submit' => 1,
					'logout' => 1,
					'message.index' => 1,
					'message.outbox' => 1,
					'message.read' => 1,
					'message.show' => 1,
					'message.store' => 1,
					'message.update' => 1,
					'product.index' => 1,
					'product.edit' => 1,
					'product.update' => 1,
					'product.destroy' => 1,
					'product.store' => 1,
					'setting.index' => 1,
					'setting.edit' => 1,
					'setting.update' => 1,
					'setting.destroy' => 1,
					'setting.store' => 1,
					'user.index' => 1,
					'user.edit' => 1,
					'user.update' => 1,
					'user.destroy' => 1,
					'user.profile' => 1,
					'user.profileUpdate' => 1,
					'user.store' => 1,
					'stock.create' => 1,
					'stock.index' => 1,
					'stock.store' => 1,
					'stock.edit' => 1,
					'stock.update' => 1,
					'stock.destroy' => 1,
					'report.product' => 1,
					'report.user' => 1,
					'report.overview' => 1,
					'indent.index' => 1,
					'indent.show' => 1,
					'indent.process' => 1,
					'indent.postProcess' => 1,
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
					'denied' => 1,
					'notfound' => 1,
					'home.index' => 1,
					'login' => 1,
					'login.submit' => 1,
					'logout' => 1,
					'help' => 1,
					'help.index' => 1,
					'indent.create' => 1,
					'indent.show' => 1,
					'indent.mine' => 1,
					'indent.store' => 1,
					'indent.edit' => 1,
					'indent.remove' => 1,
					'indent.update' => 1,
					'message.index' => 1,
					'message.read' => 1,
					'message.show' => 1,
					'reset-password' => 1,
					'retrieve-username' => 1,
					'user.profile' => 1,
					'user.profileUpdate' => 1,
					
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
					'denied' => 1,
					'notfound' => 1,
					'home.index' => 1,
					'login' => 1,
					'login.submit' => 1,
					'logout' => 1,
					'help' => 1,
					'help.index' => 1,
					'reset-password' => 1,
					'retrieve-username' => 1,
					'damage.index' => 1,
					'damage.create' => 1,
					'damage.trash' => 1,
					'damage.delete' => 1,
					'damage.update' => 1,
					'damage.restore' => 1,
					'damage.store' => 1,
					'damage.destroy' => 1,
					'report.product' => 1,
					'user.profile' => 1,
					'user.profileUpdate' => 1,
					'indent.index' => 1,
					'indent.show' => 1,
					'category.index' => 1,
					'category.store' => 1,
					'category.show' => 1,
					'category.destroy' => 1,
					'category.edit' => 1,
					'category.update' => 1,
					'message.create' => 1,
					'message.index' => 1,
					'message.outbox' => 1,
					'message.read' => 1,
					'message.show' => 1,
					'message.store' => 1,
					'product.create' => 1,
					'product.store' => 1,
					'product.edit' => 1,
					'product.destroy' => 1,
					'product.index' => 1,
					'product.update' => 1,
					'stock.create' => 1,
					'stock.edit' => 1,
					'stock.index' => 1,
					'stock.destroy' => 1,
					'stock.store' => 1,
					'stock.update' => 1,
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