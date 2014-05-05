<?php

class ContactController extends \BaseController {


	public function __construct()
	{
		parent:: __construct();
		$this->beforeFilter('sentry');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contacts = Contact::orderBy('id', 'desc')->paginate();

		return View::make('contact.index')
			->with('contacts', $contacts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('contact.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' 			=> 	'required',
			'email'			=>	'required|email',
			'phone_no'		=>	'required',
			'department'	=>	'required',
			'note'			=>	'required'

			);

		$validator		=	Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::route('contact-us')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$contact 				= 	new Contact;
			$contact->name 			=	Input::get('name');
			$contact->email 		= 	Input::get('email');
			$contact->phone_no		=	Input::get('phone_no');
			$contact->department	= 	Input::get('department');
			$contact->note 			= 	Input::get('note');
			$contact->save();

			return Redirect::route('contact-us')
				->with('message', 'Sent');
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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$replies = ContactReply::where('contact_id','=',$id)->orderBy('id','desc')->paginate(2);
		$contactById = Contact::find($id); 
		$contacts = Contact::orderBy('id', 'desc')->paginate();

		return View::make('contact.edit')
			->with('contacts', $contacts)
			->with('contactById', $contactById)
			->with('replies', $replies);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$contact = Contact::find($id);
		$rules = array(
			'reply'	=> 'required'
			);

		$validator 	= Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::route('contact.edit', array('contactById'=>$id))
				->withErrors($validator);
		}
		else{
			$mail 				=	new ContactReply;
			$mail->reply		= 	Input::get('reply');
			$mail->contact_id	=  	$id;
			$mail->save();

			Session::set('to', $contact->email);
			Session::set('name', $mail->name);
			$subj = 'Re: Contact on 2nd May 2014 at 5:00PM';
			Mail::send('contact.template.reply', array('message_body' => $mail->reply), function($message){
    			$message->to(Session::get('to'), Session::get('name'));
			});
			return Redirect::route('contact.edit', array('contactById'=>$id));
		}
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

	public function message()
	{
		$contacts = Contact::orderBy('id', 'desc')->paginate();

		return View::make('contact.message')
			->with('contacts', $contacts);
	}
}