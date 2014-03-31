<?php

class HomeController extends BaseController {

	public function index()
	{
		if(Sentry::check()) {
			$user = Sentry::getUser();

			if($user->isSuperUser()) {
				return View::make('home.super');
			}
			elseif($user->inGroup('Administrator')) {
				return View::make('home.admin');
			}
			else
				return View::make('home.index');
		}
		else
			return View::make('home.index');
	}

}