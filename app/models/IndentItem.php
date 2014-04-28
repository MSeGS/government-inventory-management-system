<?php
class IndentItem extends BaseStore
{
	
	protected $table = 'indents_items';


	public function __construct()
	{
		parent::__construct();
	}

	public function indent()
	{
		return $this->hasOne('Indent', 'id', 'indent_id');
	}

}