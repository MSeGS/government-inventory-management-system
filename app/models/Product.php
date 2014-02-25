<?php
class Product extends Eloquent
{
	
	protected $table;


	public function __construct()
	{
		$username = User::find(1)->pluck('username');
		$this->table = $username . '_product';
	}

	public function printTable()
	{
		return $this->table;
	}
	
}