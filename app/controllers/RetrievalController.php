<?php

class RetrievalController extends \BaseController {

	public function retrieveUsername()
	{
		return View::make('retrieval.username');
	}

	public function sendUsername()
	{
		$rules = array(
			'email' => 'required|email'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('retrieve-username')
				->withErrors($validator)
				->withInput(Input::all());
		}

		$user = User::where('email_id', '=', Input::get('email'))->first();
		if($user) {
			// Send the username to email here
			// $user->email_id
			// $user->username

			return Redirect::route('retrieve-username')
				->with('message', _('We have sent your username to your email. Please check your email.'));
		}
		else {
			return Redirect::route('retrieve-username')
				->with('error', _('Sorry, we cannot find username associated with this email address'));
		}
	}

	public function resetPassword()
	{
		return View::make('retrieval.password');
	}

	public function sendResetCode()
	{
		$rules = array(
			'username_email' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('reset-password')
				->withErrors($validator)
				->withInput(Input::all());
		}

		$user = User::where('email_id', '=', Input::get('username_email'))
					->orWhere('username','=',Input::get('username_email'))->first();
		if($user) {
			$user = Sentry::findUserById($user->id);
			$resetCode = $user->getResetPasswordCode();
			$resetLink = url('/new-password/'.$resetCode);
			
			// Send the reset to email here
			// $user->email_id
			// $resetCode

			return Redirect::route('reset-password')
				->with('message', _('We have sent a link to reset your password to your email.'. $resetLink));
		}
		else {
			return Redirect::route('reset-password')
				->with('error', _('Sorry, we cannot find user associated with this username or email address'));
		}
	}

	public function newPassword($code)
	{
		$validCode = false;
		
		try
		{
			$user = Sentry::findUserByResetPasswordCode($code);
			$validCode = true;

			if(!$user->checkResetPasswordCode($code))
				$validCode = false;
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$validCode = false;
		}
		
		return View::make('retrieval.new-password', compact('validCode', 'code'));
	}

	public function setNewPassword()
	{
		$rules = array(
			'password' => 'required',
			'password_confirm' => 'required|same:password'
			);
		$code = Input::get('code');
		$newPassword = Input::get('password_confirm');

		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('new-password', $code)
				->withErrors($validator)
				->withInput(Input::all());
		}

		$user = Sentry::findUserByResetPasswordCode($code);

		if($user) {

			if(!$user->checkResetPasswordCode($code)) {
				$validCode = false;
				return Redirect::route('new-password', compact('validCode'));
			}
			
			if ($user->attemptResetPassword($code, $newPassword))
	        {
				return Redirect::route('login')
					->with('message', _('New password set successfully. Login with your new password.'));
	        }
		}
		else {
			$validCode = false;
			return Redirect::route('new-password', compact('validCode'));
		}
	}
}