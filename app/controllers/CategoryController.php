<?php

class CategoryController extends \BaseController {

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
		$categories = Category::orderBy('category_name','asc')->paginate(10);
		return View::make('category.index')
			->with('categories', $categories);
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
		$category_model = new Category;

		$rules = array(
			'category_name' => 'required|alpha_num_spaces|unique:' . $category_model->getTableName() . ',category_name'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('category')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else {
			$categories  					= new Category;
			$categories->category_name		= Input::get('category_name');
			$categories->save();

			Session::flash('message', 'Successfully submitted');
			return Redirect::to('category');
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
		$categoryById	 	= Category::find($id);
		$categories			= Category::orderBy('category_name', 'asc')->paginate(20);
		return View::make('category.edit')
			->with(array('categoryById'=> $categoryById, 'categories' => $categories));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category_model = new Category;

		$rules = array(
			'category_name' => 'required|alpha_num_spaces|unique:' . $category_model->getTableName() . ',category_name,' . $id
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::to('/category/'.$id.'/edit')
				->withErrors($validator)
				->withInput(Input::all());
		}

		else{
			$category					= Category::find($id);
			$category->category_name	= Input::get('category_name');
 			$category->save();

			Session::flash('message', 'Successfully edited');
			return Redirect::to('/category');
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
		Stock::where('category_id','=',$id)->delete();
		Product::where('category_id','=',$id)->delete();
		Category::destroy($id);
		
		Session::flash('delete', 'Category deleted');
		return Redirect::to('category');
	}

}