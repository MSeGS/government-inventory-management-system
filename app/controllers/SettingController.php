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
		parent::__construct();
	}
	
	public function index()
	{
		$settings = Setting::orderBy('id', 'asc')->get();
		$options = Option::orderBy('option_title', 'asc')->get();

		return View::make('setting.index')
			->with(
				array(
					'settings'=> $settings,
					'options'=> $options
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
		$options = Option::orderBy('option_title', 'asc')->get();
		
		$rules = array();
		foreach($options as $option)
			$rules[$option->option_key] = 'required';

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('setting')
				->withErrors($validator)
				->withInput(Input::all());
		}

		foreach($options as $option) {
			
			$setting = Setting::where('option_key', '=', $option->option_key)->first();
			if(empty($setting))
				$setting = new Setting;

			$setting->option_key = $option->option_key;
			$setting->option_data = Input::get($option->option_key);
			$setting->save();
		}

		Session::flash('message', _('Settings saved successfully'));
		return Redirect::to('setting');

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

		Setting::destroy($id);
		Session::flash('delete', _('Setting Deleted'));
		return Redirect::to('setting');
	}

}