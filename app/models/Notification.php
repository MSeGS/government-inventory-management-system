<?php
class Notification extends BaseStore
{
	
	protected $table = 'notifications';


	public function __construct()
	{
		parent::__construct();
	}

	public function sender()
	{
		return $this->belongsTo('User', 'sender_id');
	}

	public function receiver()
	{
		return $this->belongsTo('User', 'receiver_id');
	}

}