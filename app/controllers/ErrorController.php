<?php

class ErrorController extends BaseController {

	public function __construct()
	{
		parent::__construct();
	}

	public function denied()
	{
		return View::make('error.denied');
	}

	public function notfound()
	{
		return View::make('error.missing');
	}

}