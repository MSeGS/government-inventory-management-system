<?php

class IndentController extends \BaseController {

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
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$filter = array(
			'limit' 			=> Input::get('limit', 10),
			'name' 			=> Input::get('name'),
			'category_id'	=> Input::get('category')
		);

		$products = Product::where(function($query){
			if(Input::get('name', null))
				$query->where('name', 'LIKE', '%' . Input::get('name') . '%');
			
			if(Input::get('category', null))
				$query->where('category_id', 'LIKE', '%' . Input::get('category') . '%');
		})
		->orderBy('name', 'asc')
		->paginate(get_setting('item_per_page', $filter['limit']));

		$categories = array();
		$index = $products->getPerPage() * ($products->getCurrentPage()-1) + 1;

		$categories = $categories + Category::orderBy('category_name', 'asc')->get()->lists('category_name', 'id');
		
		return View::make('indent.create')
			->with(array(
				'categories' => $categories,
				'products' => $products,
				'filter' => $filter,
				'index' => $index
				));
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