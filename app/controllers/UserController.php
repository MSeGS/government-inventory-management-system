<?php

class UserController extends \BaseController {

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('sentry');
	}

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

		$users = User::with('department', 'store', 'groups')->join('users_groups', 'users.id', '=', 'users_groups.user_id')->where(function($query){
				$public_group = Sentry::findGroupByName('Public');	
				$query->where('users_groups.group_id', '!=', $public_group->id);

				if(Input::get('username', null))
					$query->where('username', 'LIKE', '%' . Input::get('username') . '%');

				if(Input::get('department', null))
					$query->where('department_id', '=', Input::get('department'));

				if(Input::get('group', null))
					$query->where('users_groups.group_id', '=', Input::get('group'));

				$user = Sentry::getUser();
				if(!$user->isSuperUser()) {
					$query->where('store_id', '=', $user->store_id);
				}
			})
			->orderBy('username', 'asc')
			->paginate(30);

		$departments = Department::orderBy('name', 'asc')->lists('name', 'id');
		
		$stores = array(''=>_('Select Store'));
		$stores_temp = Store::with('department')->orderBy('store_code', 'asc')->get();
		foreach($stores_temp as $s){
			$stores[$s->id] = $s->department->name . ' (' . $s->store_code . ')';
		}

		$groups = array(''=>_('All Groups')) + Group::where('name', '<>', 'Public')
			->where(function($query){
				$user = Sentry::getUser();
				if(!$user->isSuperUser()) {
					$query->where('name', '<>', 'Super Administrator');
				}
			})
			->orderBy('name', 'asc')->lists('name', 'id');

		return View::make('user.index')
			->with('departments', $departments)
			->with('stores', $stores)
			->with('groups', $groups)
			->with('users', $users)
			->with('filter', $filter);
	}

	public function profile()
	{
		$user = Sentry::getUser();
		$groups = $user->getGroups();
		$department_name = Department::find($user->department_id);
		return View::make('user.profile')
			->with(array(
				'department_name' => $department_name,
				'groups' => $groups,
				'user' => $user));				
	}

	public function profileUpdate()
	{
		$rules = array(
			'full_name' => 'required',
			'username' => 'required',
			'email_id' => 'required|email',
			'designation' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			dd(Input::all());
			return Redirect::route('user.profile')
				->withErrors($validator)
				->withInput(Input::all());
		}

		$user = Sentry::getUser();
		$profile = Sentry::findUserById($user->id);
	    $profile->full_name = Input::get('full_name');
	    $profile->username = Input::get('username');
	    
	    if(strlen(trim(Input::get('password'))) > 0)
	    	$profile->password = Input::get('password');
		
		$profile->email_id = Input::get('email_id');
		$profile->phone_no = Input::get('phone_no');
		$profile->address = Input::get('address');
		$profile->designation = Input::get('designation');
		$profile->save();

		return Redirect::route('user.profile')->with('message', _('Profile updated successfully.'));		
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
			'group' => 'required',
			'department' => 'required',
			'full_name' => 'required',
			'username' => 'required',
			'password' => 'required',
			'email_id' => 'required|email',
			'designation' => 'required'
			);

		// Get the current group as Sentry object and check if Super Administrator group is selected or not.
		if(Input::get('group') != 0) {
			$group = Sentry::findGroupById(Input::get('group'));
			$group_permissions = $group->getPermissions();
			if( !(array_key_exists('superuser', $group_permissions) && $group_permissions['superuser']) )
				$rules['store'] = 'required|integer|min:1';
		}

		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::to('user')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else {
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

			return Redirect::to('user')
				->with('message', _('New user created successfully.'));
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
		// We need to pass these filters to view to populate filter form
		$filter = array(
			'department' => Input::get('department'),
			'username' => Input::get('username'),
			'group' => Input::get('group')
			);

		$current_user_edited = Sentry::findUserById($id);

		$users = User::with('department', 'store', 'groups')->where(function($query){
				if(Input::get('username', null))
					$query->where('username', 'LIKE', '%' . Input::get('username') . '%');

				if(Input::get('department', null))
					$query->where('department_id', '=', Input::get('department'));

				$user = Sentry::getUser();
				if(!$user->isSuperUser()) {
					$query->where('store_id', '=', $user->store_id);
				}
			})
			->orderBy('username', 'asc')
			->paginate(30);

		$departments = Department::orderBy('name', 'asc')->lists('name', 'id');
		
		$stores = array();
		$stores_temp = Store::with('department')->orderBy('store_code', 'asc')->get();
		foreach($stores_temp as $s){
			$stores[$s->id] = $s->department->name . ' (' . $s->store_code . ')';
		}

		$groups = array(''=>_('Select Group')) + Group::where('name', '<>', 'Public')->orderBy('name', 'asc')->lists('name', 'id');

		return View::make('user.edit')
			->with('departments', $departments)
			->with('stores', $stores)
			->with('groups', $groups)
			->with('users', $users)
			->with('current_user_edited', $current_user_edited)
			->with('filter', $filter);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = Sentry::findUserById($id);
		
		$userModel = new User;
		$userTable = $userModel->getTable();

		$rules = array(
			'group' => 'required',
			'department' => 'required',
			'full_name' => 'required',
			'username' => 'required|unique:' . $userTable . ',username,' . $id,
			'email_id' => 'required|email',
			'designation' => 'required'
			);

		if(!$user->isSuperUser())
			$rules['store'] = 'required';

		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('user.edit', $id)
				->withErrors($validator)
				->withInput(Input::all());
		}

		else {
			$group = Sentry::findGroupById(Input::get('group'));
			$public_group = Sentry::findGroupByName('Public');
			$group_permissions = $group->getPermissions();

			// Update the user
		    // $user = Sentry::findUserById($id);
		    $user->department_id = Input::get('department');
		    $user->full_name = Input::get('full_name');
		    $user->username = Input::get('username');
		    
		    if(strlen(trim(Input::get('password'))) > 0)
		    	$user->password = Input::get('password');
			
			$user->email_id = Input::get('email_id');
			$user->phone_no = Input::get('phone_no');
			$user->address = Input::get('address');
			$user->store_id = Input::get('store');
			$user->designation = Input::get('designation');
			$user->activated = Input::get('activated');
			$user->permissions = $group_permissions;
			$user->save();

			$user_groups = $user->getGroups();
			// Remove group from user
			foreach ($user_groups as $user_group)
				$user->removeGroup($user_group);

			// Assign the group to the user
		    $user->addGroup($group);
		    // We assign every user to public group by default.
		    $user->addGroup($public_group);
		    
			return Redirect::route('user.index')->with('message', _('User updated successfully.'));
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
		try
		{
			// Find the user using the user id
			$user = Sentry::findUserById($id);

			if($this->current_user->id == $user->id)
				return Redirect::route('user.index')
					->with('error', _('You cannot delete yourself'));

			// Delete the user
			$user->delete();
			return Redirect::route('user.index')
				->with('delete', _('User removed successfully'));
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			return Redirect::route('user.index')
				->with('error', _('User not found'));
		}
	}

}