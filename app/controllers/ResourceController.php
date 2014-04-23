<?php

class ResourceController extends \BaseController {

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
		$resources = Resource::orderBy('name', 'asc')->paginate();
		$index = $resources->getPerPage() * ($resources->getCurrentPage()-1) + 1;
		return View::make('resource.index')
			->with('resources', $resources)
			->with('index', $index);
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
			'name' 	=> 	'required',
			'route' =>	'unique:resources,route',
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::to('resource')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$resource = new Resource;
			$resource->name 	= 	Input::get('name');
			$resource->route 	= 	Input::get('route');
			$resource->save();

			Session::flash('message', 'Successfully added');
			return Redirect::to('resource');

			

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
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$resourceById = Resource::find($id);
		$resources = Resource::orderBy('name', 'asc')->paginate();
		$index = $resources->getPerPage() * ($resources->getCurrentPage()-1) + 1;
		return View::make('resource.edit')
			->with(array(
				'resources'=> $resources,
				 'resourceById' => $resourceById,
				 'index'		=> $index
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
			'name' 	=> 	'required',
			'route' =>	'required'
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::to('resource/'. $id. '/edit')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$resource = Resource::find($id);
			$resource->name 	= 	Input::get('name');
			$resource->route 	= 	Input::get('route');
			$resource->save();

			Session::flash('message', 'Successfully edited');
			return Redirect::to('resource');
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
		Resource::destroy($id);

		Session::flash('delete', 'Resource Deleted');
		return Redirect::to('resource');
	}

}