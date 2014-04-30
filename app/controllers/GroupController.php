<?php

class GroupController extends \BaseController {

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
		
		$groups = Group::orderBy('id', 'asc')->paginate();
		$index 	= $groups->getPerPage() * ($groups->getCurrentPage()-1)+1; 
		return View::make('group.index')
			->with('groups', $groups)
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
		$rules= array(
			'name' 	=> 	'required',
			);

		$validator = Validator::make(Input::all(), $rules);

			if ($validator->fails()){
				return Redirect::to('group')
					->withErrors($validator)
					->withInput(Input::all());
			}
			else{
				$group 			= 	new Group;
				$group->name 	=	Input::get('name');	
				$group->save();

				Session::flash('message', _('Successfully Added'));
				return Redirect::route('group.index');
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
		$group = Group::find($id);
		$groups = Group::orderBy('id', 'asc')->paginate();
		$index 	= $groups->getPerPage() * ($groups->getCurrentPage()-1)+1; 
		return View::make('group.edit')
			->with(array(
				'groups' 		=> $groups,
				'current_group' => $group,
				'index' 		=> $index));
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
			return Redirect::route('group.edit')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$group 			= Group::find($id);
			$group->name 	= Input::get('name');
			$group->save();

			Session::flash('message', _('Successfully Edited'));
			return Redirect::route('group.index');
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

		Session::flash('delete', 'Group deleted');
		return Redirect::route('group.index');
	}

	public function permission($id)
	{
		$groups = Sentry::findAllGroups();
		$current_group = Sentry::findGroupById($id);
		$resources = Resource::orderBy('name', 'asc')->get();
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

		Session::flash('message', _('Successfully Saved'));
		return Redirect::route('group.permission', $group->id);
	}

}