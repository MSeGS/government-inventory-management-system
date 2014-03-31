<?php
class Product extends BaseStore
{
	
	protected $table = 'products';

	public function __construct()
	{
		parent::__construct();
	}

}