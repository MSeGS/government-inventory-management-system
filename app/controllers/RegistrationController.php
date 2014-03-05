<?php
class RegistrationController extends BaseController
{
	public function index()
	{
		return View::make('registration.index');
	}

	public function register()
	{
		$rules=array(
			'username'		=>'required',
			'password'		=>'required|alphaNum|min:5',
			'full_name'		=>'required',
			'address'		=>'required',
			'designation'	=>'required',
			'phone_no'		=>'required',
			'email_id'		=>'required',
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()){
			return Redirect::to('registration')
			->withInput(Input::all())
			->withErrors($validator);
		}

		else{

			$user = Sentry::createUser(array(
				'username' 		=> Input::get('username'),
				'password' 		=> Input::get('password'),
				
				'address' 		=> Input::get('address'),
				'email_id' 		=> Input::get('email_id'),
				'phone_no' 		=> Input::get('phone_no'),
				'designation' 	=> Input::get('designation'),
				'activated'		=> 'false',
				));	

			

			$adminGroup = Sentry::findGroupById(4);

		    // Assign the group to the user
		    $user->addGroup($adminGroup);
		    return Redirect::to('login');



			//$activationCode = $user->getActivationCode(); 
		}
	}
}