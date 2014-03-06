<?php

class BaseController extends Controller {

	public function __construct()
	{
		// Check permission on route
		$route = Route::currentRouteName();

		if(Sentry::check()) {
			$user = Sentry::getUser();
			$groups = $user->getGroups();
		}
		else {
			$groups = array('Public');
		}

		// if($route == 'resource.create')
			// exit('a');
			// return Redirect::route('home.index');

	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}