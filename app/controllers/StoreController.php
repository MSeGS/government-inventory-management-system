<?php

class StoreController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('sentry');
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{ 
		$stores = Store::with(array('Department' => function($query){
			$query->orderBy('name', 'asc');
		}))->paginate();

		$departments = Department::where(function($query){
			$existing_stores = Store::lists('department_id');
			if(!empty($existing_stores))
				$query->whereNotIn('id', $existing_stores);

		})->orderBy('name', 'asc')->lists('name', 'id');

		$index = $stores->getPerPage() * ($stores->getCurrentPage()-1)+1;

		return View::make('store.index')
			->with(array(
				'stores'	  	=> $stores,
				'departments' 	=> $departments,
				'index'			=> $index
				));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'department_id'		=> 'required',
			'store_code'		=> 'required|alpha_dash|unique:stores,store_code'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('store.index')
				->withErrors($validator)
				->withInput(Input::all());
		}

		$store = new Store;
		$store->department_id = Input::get('department_id');
		$store->store_code = Input::get('store_code');
		$store->save();

		$store->prepareDbTables($store->id);

		return Redirect::route('store.index')->with('message', _('Store created successfully'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$current_store = Store::with('Department')->find($id);
		
		$stores = Store::with(array('Department' => function($query){
			$query->orderBy('name', 'asc');
		}))->paginate();

		$departments = Department::where(function($query){
			$existing_stores = Store::lists('department_id');
			if(!empty($existing_stores))
				$query->whereNotIn('id', $existing_stores);

		})->orderBy('name', 'asc')->lists('name', 'id');

		$index = $stores->getPerPage() * ($stores->getCurrentPage()-1)+1;

		return View::make('store.edit')
			->with(array(
				'stores'=> $stores,
				'current_store' => $current_store,
				'departments' => $departments,
				'index'	=>	$index
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
			'store_code'		=> 'required|alpha_dash|unique:stores,store_code,' . $id
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('store.edit', $id)
				->withErrors($validator)
				->withInput(Input::all());
		}

		$store = Store::find($id);
		$store->store_code = Input::get('store_code');
		$store->save();

		$store->prepareDbTables($store->id);

		return Redirect::route('store.edit', $id)->with('message', '<i class="fa fa-check"></i> ' . _('Store updated successfully'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Store::destroy($id);

		return Redirect::route('store.index')
			->with('message', _('Store deleted'));
	}

}