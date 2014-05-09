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

	public static function send()
	{
		$notifications= new Notification;
		$notifications->sender_id = Input::get('sender_id');
		$notifications->receiver_id = Input::get('receiver_id');
		$notifications->message = Input::get('message');
		$notifications->created_at;
		$notifications->save();
	}
}