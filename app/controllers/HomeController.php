<?php

class HomeController extends BaseController {

	public function index()
	{
		if(Sentry::check()) {
			$user = Sentry::getUser();
			$admin = Sentry::findGroupByName('Administrator');
			$indentor = Sentry::findGroupByName('Indentor');

			if($user->isSuperUser()) {
				return View::make('home.super');
			}
			elseif($user->inGroup($admin)) {
				return View::make('home.admin');
			}
			else
				return View::make('home.index');
		}
		else
			return View::make('home.index');
	}

}