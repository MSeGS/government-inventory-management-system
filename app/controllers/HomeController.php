<?php

class HomeController extends BaseController {

	public function index()
	{
		if(Sentry::check()) {
			$admin = Sentry::findGroupByName('Administrator');
			$indentor = Sentry::findGroupByName('Indentor');
			$storekeeper = Sentry::findGroupByName('Store Keeper');

			if($this->current_user->isSuperUser()) {
				return View::make('home.super');
			}
			elseif($this->current_user->inGroup($admin)) {
				return View::make('home.admin');
			}
			elseif($this->current_user->inGroup($indentor)){
				return View::make('home.indentor');
			}
				elseif($this->current_user->inGroup($storekeeper)){
				return View::make('home.storekeeper');
			}
		}
		else
			return View::make('home.index');
	}

}