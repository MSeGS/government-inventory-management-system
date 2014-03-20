<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$departments = array();
		$ds = Department::orderBy('name', 'asc')->paginate(15);
		foreach($ds as $d){
			$departments[$d->id] = $d->name;
			
		}
		
		$stores = array();
		$Ss = Store::orderBy('id', 'asc')->paginate(15);
		foreach($Ss as $s){
			$stores[$s->id] = $s->id;
		}

		$groups = array();
		$Gs = Group::orderBy('id', 'asc')->paginate(5);
		foreach($Gs as $s){
			$groups[$s->id] = $s->id;

		}

		$groups2 = array();
		$G2 = Group::orderBy('name', 'asc')->paginate(5);
		foreach($G2 as $s2){
			$groups2[$s2->name] = $s2->name;

		}
		
		return View::make('user.index')
			->with('departments', $departments)
			->with('stores', $stores)
			->with('groups', $groups)
			->with('groups2', $groups2);
			
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$rules = array(
			'full_name' 	=> 	'required',
			'username'		=>	'required',
			'password'		=> 	'required',
			'email_id'		=> 	'required',
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
				    'department'	=> Input::get('department'),
				    'full_name'		=> Input::get('full_name'),
				    'username' 		=> Input::get('username'),
				    'password'		=> Input::get('password'),
					'email_id' 		=> Input::get('email_id'),
					'phone_no' 		=> Input::get('phone_no'),
					'address' 		=> Input::get('address'),
					'store_id'		=> Input::get('store_id'),
					'designation' 	=> Input::get('designation'),
					'activated'		=> 'false',
					));	
				  
		Session::flash('message', 'Successfully created');
		return Redirect::to('user');

		}

			$adminGroup = Sentry::findGroupById(4);

		    // Assign the group to the user
		    $user->addGroup($adminGroup);
		    return Redirect::to('login');


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
		//
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
		//
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