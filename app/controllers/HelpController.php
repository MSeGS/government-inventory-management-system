<?php

class HelpController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('sentry');
	}
	
	public function index()
	{	

		$currentUser = Sentry::getUser();
		$currentUserGroup = $currentUser->getGroups();
		$currentUserGroup = $currentUserGroup->lists('id');
		if (in_array(2, $currentUserGroup))
		{

			$helps = Help::orderBy('id', 'asc')->paginate();  
		}
		else
		{
			$helps = Help::whereIn('access_level', $currentUserGroup)->paginate();      
		}                                               
		return View::make('help.index')
			->with(array(
				'helps' => $helps
				));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$groups = array(''=>_('Select Group')) + Group::where('name', '<>', 'Public')
			->where(function($query){
				$user = Sentry::getUser();
				if($user->isSuperUser()) {
					$query->where('name', '!=', 'Super Administrator');
				}
			})
			->orderBy('name', 'asc')->lists('name', 'id');


		
		return View::make('help.create')
			->with(array(
				'groups' => $groups
				));
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
			'title' => 	'required',
			'body'	=>	'required',
			
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('help.create')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
		$help	=  new Help;
		$help->access_level = Input::get('group');
		$help->title = Input::get('title');
		$help->body = Input::get('body');
		$help->created_at;
		$help->save();

		return Redirect::route('help.index')
			->with('message', _('Help Successfully added'));
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
		$groups = array(''=>_('Select Group')) + Group::where('name', '<>', 'Public')
			->where(function($query){
				$user = Sentry::getUser();
				if($user->isSuperUser()) {
					$query->where('name', '!=', 'Super Administrator');
				}
			})
			->orderBy('name', 'asc')->lists('name', 'id');
		
		$currenthelp = Help::find($id);
				
		return View::make('help.edit')
			->with(array(
				'groups' => $groups,
				'currenthelp' => $currenthelp
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
			'group' => 'required',
			'title' => 	'required',
			'body'	=>	'required',
			
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('help.edit')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
		$help=Help::find($id);
		$help->access_level = Input::get('group');
		$help->title = Input::get('title');
		$help->body = Input::get('body');
		$help->created_at;
		$help->save();

		return Redirect::route('help.index')
			->with('message', _('Help Successfully update'));
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
		Help::destroy($id);

		Session::flash('message', _('Help Deleted'));
		return Redirect::route('help.index');
	}

}