<?php

class HomeController extends BaseController {

	public function index()
	{
		if(Sentry::check()) {
			$admin = Sentry::findGroupByName('Administrator');
			$indentor = Sentry::findGroupByName('Indentor');
			$storekeeper = Sentry::findGroupByName('Store Keeper');

			if($this->current_user->isSuperUser()) {
				$counts = DB::select(DB::Raw(
					"SELECT 
						( SELECT COUNT(*) FROM (SELECT id FROM stores ) as stores ) 
						AS storesCount, 
						( SELECT COUNT(*) FROM ( SELECT `user_id` FROM `users_groups` WHERE `group_id` = 1 ) as admins ) 
						AS adminsCount,
						( SELECT COUNT(*) FROM (SELECT `user_id` FROM `users_groups` WHERE `group_id` = 2 ) as storekeepers) 
						AS storeKeepersCount,
						( SELECT COUNT(*) FROM (SELECT `user_id` FROM `users_groups` WHERE `group_id` = 3 ) as indentors) 
						AS indentorsCount,
						( SELECT COUNT(*) FROM (SELECT DISTINCT `department_id` FROM `users` WHERE department_id > 0) as departments) 
						AS departmentsCount"
					) 
				);
				
				return View::make('home.super')->with(compact('counts'));
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

	public function super_reports($value='')
	{
		exit('ads');
	}

}