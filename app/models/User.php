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

	public function indents()
	{
		return $this->hasMany('Indent', 'indentor_id', 'id');
	}

	public function damages()
	{
		return $this->hasMany('Damage');
	}

	public static function indentors($store_id = null)
	{
		if($store_id == null) {
			$user = Sentry::getUser();
			$store_id = $user->store_id;
		}

		$indentor_group_id = Group::where('name', '=', 'Indentor')->pluck('id');
		$user_group_model = new UserGroup;
		$user_groups_table = $user_group_model->getTable();
		$user_model = new User;
		$user_table = $user_model->getTable();
		
		$indentors = User::join($user_groups_table, $user_groups_table . ".user_id", '=', $user_table . ".id")
			->where($user_groups_table . '.group_id', '=', $indentor_group_id)
			->where('store_id','=',$store_id)->get();

		return $indentors;
	}
}