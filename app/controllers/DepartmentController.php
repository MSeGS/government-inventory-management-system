<?php

class DepartmentController extends \BaseController {

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
		$filter = array(
			'deptsearch' => Input::get('deptsearch')
			);

		if(isset($_GET['deptsearch']) && $_GET['deptsearch'] != ""){
			$departments = Department::where('name', 'LIKE',  '%' . Input::get('deptsearch') . '%')->paginate();
			$deptsearch=$_GET['deptsearch'];
		}
		else{
			$departments = Department::orderBy('name', 'asc')->paginate();
			$deptsearch='';
		}
		
		$index = $departments->getPerPage() * ($departments->getCurrentPage()-1) + 1;
		return View::make('department.index')
			->with('departments', $departments)
			->with('index', $index)
			->with('filter', $filter);

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
		$rules = array(
			'name' 	=> 	'required',
			
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('department.index')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$department = new Department;
			$department->name 	= 	Input::get('name');
			$department->save();

			Session::flash('message', _('Successfully added'));
			return Redirect::route('department.index');
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
		$filter = array(
			'deptsearch' 	=> Input::get('deptsearch')
			);
		
		$departmentById = Department::find($id);

		if(isset($_GET['deptsearch']) && $_GET['deptsearch'] != ""){
			$departments = Department::where('name', 'LIKE',  '%' . Input::get('deptsearch') . '%')->paginate();
			$deptsearch=$_GET['deptsearch'];
		}
		else{
			$departments = Department::orderBy('name', 'asc')->paginate();
			$deptsearch='';
		}


		
		$index = $departments->getPerPage() * ($departments->getCurrentPage()-1) + 1;
		return View::make('department.edit')
			->with(array('departments'=> $departments, 
						 'departmentById' => $departmentById, 
						 'index' => $index,
						 'filter'=>$filter,
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
			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('department.edit')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$department = Department::find($id);
			$department->name 	= 	Input::get('name');
			$department->save();

			Session::flash('message', _('Successfully edited'));
			return Redirect::route('department.index');
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
		Department::destroy($id);

		Session::flash('delete', _('Department Deleted'));
		return Redirect::to('department');
	}

}