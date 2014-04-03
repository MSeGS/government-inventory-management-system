<?php

class SettingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$settings = Setting::orderBy('id', 'asc')->paginate();
		$setting_keys = $settings->lists('option_key');
		$options = Option::orderBy('option_title', 'asc')
			->whereNotIn('option_key', $setting_keys)
			->get()
			->lists('option_title','option_key');
		
		$optionSelect = array(''=>'Select Option', $options);

		return View::make('setting.index')
			->with(
				array(
					'settings'=> $settings,
					'optionSelect'=> $optionSelect
					)
				);
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
			'option_data'	=>	'required',
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::to('setting')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$setting = new Setting;
			$setting->option_key = Input::get('option_key');
			$setting->option_data = Input::get('option_data');
			$setting->save();

			Session::flash('message', 'Successfully added');
			return Redirect::to('setting');
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}