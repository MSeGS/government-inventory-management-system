<?php

class SettingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->beforeFilter('sentry');
	}
	
	public function index()
	{
		$settings = Setting::orderBy('id', 'asc')->paginate();
		$options = Option::orderBy('option_title', 'asc')
			->where(function($query){
				$setting_kes = Setting::orderBy('id', 'asc')->get()->lists('option_key');
				if($setting_kes)
					$query->whereNotIn('option_key', $setting_kes);
			})
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

			Session::flash('message', _('Successfully added'));
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
		
		$currentSetting = Setting::find($id);
		$currentOption = Option::find($id);
		$settings = Setting::orderBy('option_key', 'asc')->paginate();
		return View::make('setting.edit')
			->with(array(
				'settings'=> $settings, 
				'currentOption' => $currentOption,
				'currentSetting' => $currentSetting
				));
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
			'option_data'	=>	'required',
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::to('setting/'. $id. '/edit')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$setting = Setting::find($id);
			$setting->option_data =	Input::get('option_data');
			$setting->save();

			Session::flash('message', _('Successfully edited'));
			return Redirect::to('setting');
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

		$option = new Option;
		$option::find($id);
		$option->delete();

		Session::flash('delete', _('<strong>Setting Deleted</strong>'));
		return Redirect::to('setting');
	}

}