<?php
class ContactReply extends BaseStore
{
	
	protected $table = 'contact_reply';

	public function __construct()
	{
		parent::__construct();
	}

	public function contact()
	{
		return $this->belongsTo('Contact');
	}

}