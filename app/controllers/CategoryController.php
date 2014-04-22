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
			return Redirect::route('category.index')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else {
			$categories  					= new Category;
			$categories->category_name		= Input::get('category_name');
			$categories->save();

			Session::flash('message', 'Successfully submitted');
			return Redirect::route('category.index');
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
		if($id == 1)
			return Redirect::route('category.index');

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
		if($id == 1)
			return Redirect::route('category.index');

		$category_model = new Category;

		$rules = array(
			'category_name' => 'required|alpha_num_spaces|unique:' . $category_model->getTableName() . ',category_name,' . $id
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::route('category.edit', $id)
				->withErrors($validator)
				->withInput(Input::all());
		}

		else{
			$category					= Category::find($id);
			$category->category_name	= Input::get('category_name');
 			$category->save();

			return Redirect::route('category.index')
				->with('message', _('Category successfully updated'));
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
		// Check if uncategorized category
		if($id == 1)
			return Redirect::route('category.index');

		// Assign all products and stocks to Uncategorized category.
		Stock::where('category_id','=',$id)->update(array('category_id'=>1));
		Product::where('category_id','=',$id)->update(array('category_id'=>1));
		Category::destroy($id);
		
		return Redirect::route('category.index')
			->with('delete', _('Category deleted and category products moved to Uncategorized.'));
	}

}