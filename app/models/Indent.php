<?php
class Indent extends BaseStore
{
	
	protected $table = 'indents';


	public function __construct()
	{
		parent::__construct();
	}

	public function items()
	{
		return $this->hasMany('IndentItem');
	}

	public function requirements()
	{
		return $this->hasMany('Requirement');
	}
}