<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// We need to pass these filters to view to populate filter form
		$filter = array(
			'department' => Input::get('department'),
			'username' => Input::get('username'),
			'group' => Input::get('group')
			);


		$users = User::with('department', 'store', 'groups')->where(function($query){
				if(Input::get('username', null))
					$query->where('username', 'LIKE', '%' . Input::get('username') . '%');

				if(Input::get('department', null))
					$query->where('department_id', '=', Input::get('department'));
			})
			->orderBy('username', 'asc')
			->paginate(30);

		$departments = array(''=>'Select Department') + Department::orderBy('name', 'asc')->lists('name', 'id');
		
		$stores = array();
		$stores_temp = Store::with('department')->orderBy('store_code', 'asc')->get();
		foreach($stores_temp as $s){
			$stores[$s->id] = $s->department->name . ' (' . $s->store_code . ')';
		}

		$groups = array(''=>'Select Group') + Group::where('name', '<>', 'Public')->orderBy('name', 'asc')->lists('name', 'id');

		return View::make('user.index')
			->with('departments', $departments)
			->with('stores', $stores)
			->with('groups', $groups)
			->with('users', $users)
			->with('filter', $filter);
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
			'group' => 'required|integer|min:1',
			'department' => 'required|integer|min:1',
			'full_name' => 'required',
			'username' => 'required',
			'password' => 'required|min:5',
			'email_id' => 'required|email',
			'store' => 'required|integer|min:1',
			'designation' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::to('user')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else
		{
			$group = Sentry::findGroupById(Input::get('group'));
			$public_group = Sentry::findGroupByName('Public');
			$group_permissions = $group->getPermissions();

			// Create the user
		    $user = Sentry::createUser(array(
		    	'department_id'	=> Input::get('department'),
		    	'full_name'		=> Input::get('full_name'),
		    	'username'		=> Input::get('username'),
		    	'password'		=> Input::get('password'),
				'email_id'		=> Input::get('email_id'),
				'phone_no'		=> Input::get('phone_no'),
				'address' 		=> Input::get('address'),
				'store_id'		=> Input::get('store'),
				'designation' 	=> Input::get('designation'),
				'activated' 	=> Input::get('activated'),
				'permissions'	=> $group_permissions
		  	));

			// Assign the group to the user
		    $user->addGroup($group);
		    // We assign every user to public group by default.
		    $user->addGroup($public_group);

			return Redirect::to('user')->with('message', 'User created successfully.');
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