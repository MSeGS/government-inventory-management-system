<?php

class HomeController extends BaseController {

	public function index()
	{
		if(Sentry::check()) {
			$user = Sentry::getUser();
			$admin = Sentry::findGroupByName('Administrator');
			$indentor = Sentry::findGroupByName('Indentor');
			$storekeeper = Sentry::findGroupByName('Store Keeper');

			if($user->isSuperUser()) {
				return View::make('home.super');
			}
			elseif($user->inGroup($admin)) {
				return View::make('home.admin');
			}
			elseif($user->inGroup($indentor)){
				return View::make('home.indentor');
			}
				elseif($user->inGroup($storekeeper)){
				return View::make('home.storekeeper');
			}
		}
		else
			return View::make('home.index');
	}

}