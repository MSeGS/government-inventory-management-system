<?php
class BaseStore extends Eloquent
{

	public function __construct()
	{
		if(Sentry::check()) {
			$user = Sentry::getUser();
			if($user->store_id)
				$this->table = 'store' . $user->store_id . '_' . $this->table;
		}
	}

}