<?php

class OptionController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('sentry');
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$options = Option::orderBy('option_key', 'asc')->paginate(10);
		return View::make('option.index')
			->with('options', $options);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'option_key' 	=> 	'required',
			'option_title'	=>	'required',
			'option_data'	=>	'required',
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::to('option')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$option = new Option;
			$option->option_key		= 	Input::get('option_key');
			$option->option_title	= 	Input::get('option_title');
			$option->option_data 	= 	Input::get('option_data');
			$option->save();

			Session::flash('message', _('Successfully added'));
			return Redirect::to('option');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$optionById = Option::find($id);
		$options = Option::orderBy('option_data', 'asc')->get();
		return View::make('option.edit')
			->with(array('options'=> $options, 'optionById' => $optionById));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
			'option_key' 	=> 	'required',
			'option_title' 	=> 	'required',
			'option_data'	=>	'required',
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::to('option/'. $id. '/edit')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$option = Option::find($id);
			$option->option_key		= 	Input::get('option_key');
			$option->option_title 	= 	Input::get('option_title');
			$option->option_data 	= 	Input::get('option_data');
			$option->save();

			Session::flash('message', _('Successfully edited'));
			return Redirect::to('option');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		option::destroy($id);

		Session::flash('message', _('Option Deleted'));
		return Redirect::to('option');
	}

}