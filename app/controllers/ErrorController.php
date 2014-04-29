<?php

class ErrorController extends BaseController {

	public function denied()
	{
		return View::make('error.denied');
	}

	public function notfound()
	{
		return View::make('error.missing');
	}

}