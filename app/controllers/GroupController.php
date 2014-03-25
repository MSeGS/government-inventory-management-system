<?php

class GroupController extends \BaseController {

	public function __construct()
	{
		// $this->beforeFilter('sentry');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// $group = Sentry::findGroupById(1);
		// echo "<pre>";
		// print_r($group->permissions);
		// $resources = Resource::all();
		// print_r($resources->toArray());
		// echo "</pre>";
		// exit;

		$groups = Sentry::findAllGroups();
		return View::make('group.index')
			->with('groups', $groups);
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
		$rules= array(
			'name' 	=> 	'required',
			);

		$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()){
				return Redirect::to('group')
					-withErrors($validator)
					->withInput(Input::all());
			}
			else{
				$group 			= 	new Group;
				$group->name 	=	Input::get('name');	
				$group->save();

				Session::flash('message', 'Successfully Added');
				return Redirect::to('group');
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
		$groupById = Group::find($id);
		$groups = Sentry::findAllGroups();
		return View::make('group.edit')
			->with(array('groups' => $groups, 'groupById' => $groupById));
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
			'name' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()){
			return Redirect::to('group'. $id .'/edit')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$group 			= Group::find($id);
			$group->name 	= Input::get('name');
			$group->save();

			Session::flash('message', 'Successfully Edited');
			return Redirect::to('group');
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
		Group::destroy($id);

		Session::flash('message', 'Group deleted');
		return Redirect::to('group');
	}

	public function permission($id)
	{
		$groups = Sentry::findAllGroups();
		$current_group = Sentry::findGroupById($id);
		$resources = Resource::all();
		return View::make('group.permission')
			->with(array('resources'=>$resources, 'current_group'=>$current_group, 'groups'=>$groups));
	}

	public function updatePermission($id)
	{
		$group = Group::find($id);
		$postData = Input::get('permission');
		$set = json_encode($postData);
		
		$group->permissions = $set;
		$group->save();

		return Redirect::to('group/'.$group->id.'/permission');
	}

}