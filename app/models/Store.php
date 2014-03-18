<?php
class Store extends Eloquent
{
	protected $table = 'stores';
	
	public function department()
	{
		return $this->hasOne('Department', 'id', 'department_id');
	}
}