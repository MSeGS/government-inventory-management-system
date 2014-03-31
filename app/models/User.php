<?php
class User extends Eloquent
{
	protected $table = 'users';

	public function department()
	{
		return $this->hasOne('Department', 'id', 'department_id');
	}

	public function store()
	{
		return $this->hasOne('Store', 'id', 'store_id');
	}

	public function groups()
	{
		return $this->belongsToMany('Group', 'users_groups', 'user_id', 'group_id');
	}

}