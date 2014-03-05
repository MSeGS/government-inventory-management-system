<?php
class RegistrationController extends BaseController
{
	public function index()
	{
		return View::make('registration.index');
	}
}