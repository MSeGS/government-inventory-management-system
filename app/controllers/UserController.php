<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = array(
			'department' => Input::get('department'),
			'username' => Input::get('username'),
			'group' => Input::get('group')
			);

		if(Input::get('search')){
			
			$users = User::where(function($query){
						$filter = array(
							'department' => Input::get('department'),
							'username' => Input::get('username'),
							'group' => Input::get('group')
							);

						if($filter['department'] != 0 && $filter['department'] != "")
							$query->where('department_id', '=', $filter['department']);
						
						 //->where('group_id','=',"$group_id")
						if($filter['username'] != "")
							$query->where('username', 'like', "%" . $filter['username'] . "%");

					})->paginate();
		}
		else {
				$users = User::orderBy('full_name', 'asc')->paginate();
		}
		$departments = array();
		$ds = Department::orderBy('name', 'asc')->get();
		$departments['']="Select Department";
		foreach($ds as $d){
			$departments[$d->id] = $d->name;
			
		}
		
		$stores = array();
		$Ss = Store::orderBy('id', 'asc')->get();
		$stores['']="Select Store";
		foreach($Ss as $s){
			$stores[$s->id] = Department::find($s->department_id)->name . ' (' . $s->store_code . ')';
		}

		$groups = array();
		$Gs = Group::orderBy('name', 'asc')->get();
		$groups['']="Select Role";
		foreach($Gs as $s){
				$groups[$s->id] = $s->name;
		}

		/*$groups2 = array();
		$G2 = Group::orderBy('name', 'asc')->paginate(5);
		foreach($G2 as $s2){
			$groups2[$s2->name] = $s2->name;

		}*/
		
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
		

			
			    /*
			   	$adminGroup = Sentry::findGroupByname('Administrator');																												
			    $superGroup = Sentry::findGroupByName('Super Administrator');
		    	$inventorGroup = Sentry::findGroupByName('Indentor')

			    /* Assign the group to the user
			     $user->addGroup($adminGroup);
			     $user->addGroup($superGroup);
			     $user->addGroup($indentorGroup);*/
		
			  
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'group_id'		=>  'required',
			'department'	=> 	'required',
			'full_name' 	=> 	'required',
			'username'		=>	'required',
			'password'		=> 	'required|min:5',
			'email_id'		=> 	'required|email',
			'store'		=>	'required',
			'designation'	=>	'required'
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::to('user')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else
		{
			// Create the user
		    $user = Sentry::createUser(array(
		    	//'group_id'		=> Input::get('group_id'),
		    	'department_id'	=> Input::get('department'),
		    	'full_name'		=> Input::get('full_name'),
		    	'username'		=> Input::get('username'),
		    	'password'		=> Input::get('password'),
				'email_id'		=> Input::get('email_id'),
				'phone_no'		=> Input::get('phone_no'),
				'address' 		=> Input::get('address'),
				'store_id'		=> Input::get('store'),
				'designation' 	=> Input::get('designation')
		  	));

			$group = Sentry::findGroupByname(Input::get('group_id'));
			
			// Assign the group to the user
		    $user->addGroup($group);

			return Redirect::to('user')->with('message', 'Successfully created');
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