<?php

class BaseController extends Controller {

	public function __construct()
	{
		$this->per_page = 30;
		$this->current_route = Route::getCurrentRoute()->getName();
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