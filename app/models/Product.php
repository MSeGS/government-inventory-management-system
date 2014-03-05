<?php
class Product extends Eloquent
{
	
	protected $table = 'products';


	public function __construct()
	{
		$username = User::find(1)->pluck('username');
	}

	public function printTable()
	{
		return $this->table;
	}
	
}