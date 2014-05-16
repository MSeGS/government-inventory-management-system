<?php
class Category extends BaseStore
{
	
	protected $table = 'categories';
	protected $softDelete = true;


	public function __construct()
	{
		parent::__construct();
	}

	public function products()
	{
		return $this->hasMany('Product');
	}

}