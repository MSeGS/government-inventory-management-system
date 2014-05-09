<?php

class MessageController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('sentry');
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = new User;
		$currentUser = Sentry::getUser()->id;
		$notifications = Notification::where('receiver_id', '=', $currentUser)->paginate();
			return View::make('message.index')
			->with(array(
				'notifications' => $notifications,
				'currentUser' => $currentUser,
				'users' => $users
				));
	}

	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$currentUser = Sentry::getUser()->store_id;
		$userid = Sentry::getUser()->id;
		$users = User::where('store_id','=', $currentUser)
			->where('id', '!=', $userid)
			->get()
			->lists('full_name','id');

		$userSelect = array(''=> _('Select User') , $users);

		return View::make('message.compose')
		->with(array(
			'currentUser' => $currentUser,
			'userid' => $userid,
			'users' => $users,
			'userSelect' => $userSelect
			));
	}

	public function outbox()
	{

		$currentUser = Sentry::getUser()->id;
		$notifications = Notification::where('sender_id', '=', $currentUser)->paginate();
		return View::make('message.outbox')
		 ->with(array(
		 		'notifications' => $notifications,
		 		'currentUser' => $currentUser
		 		));
	}
	

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'sender_id' => 'required',
			'message' 	=> 	'required',
			
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('message.create')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
		
		$send = Notification::send();
		return Redirect::route('message.create')
			->with('message', _('Message Successfully Send'));
			
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$currentMessage = Notification::find($id);
		$currentMessage->status = 'read';
		$currentMessage->save();
		if(isset($_POST['id'])){
			return View::make('message.index');
		} else {
			return View::make('message.show')
			->with(array(
				'currentMessage' => $currentMessage
				
				));	
		}
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$notifications	= Notification::find($id);
		$notifications->status = 'read';
		$notifications->save();

		return Redirect::route('message.index')
			->with('message', _('Message marked as read'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}