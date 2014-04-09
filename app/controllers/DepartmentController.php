<?php

class DepartmentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = array(
			'department' => Input::get('department')
			);

		if(isset($_GET['search'])){
			$departments = Department::where('name', 'LIKE',  '%' . Input::get('deptsearch') . '%')->paginate();
		}
		else{
			$departments = Department::orderBy('name', 'asc')->paginate();
		}
		return View::make('department.index')
			->with('departments', $departments)
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
			return Redirect::to('department')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$department = new Department;
			$department->name 	= 	Input::get('name');
			$department->save();

			Session::flash('message', 'Successfully added');
			return Redirect::to('department');
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
			'department' => Input::get('department'),
			'username' => Input::get('username')
			);
		
		$departmentById = Department::find($id);
		$departments = Department::orderBy('name', 'asc')->paginate(30);
		
		return View::make('department.edit')
			->with(array('departments'=> $departments, 
						 'departmentById' => $departmentById, 
						 'filter'=>$filter
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
			return Redirect::to('department/'. $id. '/edit')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$department = Department::find($id);
			$department->name 	= 	Input::get('name');
			$department->save();

			Session::flash('message', 'Successfully edited');
			return Redirect::to('department');
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

		Session::flash('delete', 'Department Deleted');
		return Redirect::to('department');
	}

}