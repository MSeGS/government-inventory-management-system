<?php

class ContactController extends \BaseController {

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
			return Redirect::route('contact.index')
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
		$contactById = Contact::find($id); 
		$contacts = Contact::orderBy('id', 'desc')->paginate();

		return View::make('contact.reply')
			->with('contacts', $contacts)
			->with('contactById', $contactById);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'mail_text'	=> 'required'
			);

		$validator 	= Validator::make(Input::all(), $rules);

		if($validator->passes()){
			$mail 				=	Contact::find($id);
			$mail->mail_text	= 	Input::get('mail_text');
			$mail->save();
			Session::set('to', $mail->email);
			Session::set('name', $mail->name);
			Mail::send('contact.template.reply', array('message_body' => $mail->mail_text), function($message) {
    			$message->to(Session::get('to'), Session::get('name'));//->subject('replyasd');
			});

			return Redirect::route('contact.index');
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