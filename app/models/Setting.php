<?php
class Setting extends BaseStore
{
	protected $table = 'options';
	public $timestamps = false;
	
	public function __construct()
	{
		parent::__construct();
	}

}