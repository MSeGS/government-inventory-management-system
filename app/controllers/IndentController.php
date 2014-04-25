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
			'limit' 			=> Input::get('limit', get_setting('item_per_page')),
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
		->paginate($filter['limit']);

		$categories = array();
		$index = $products->getPerPage() * ($products->getCurrentPage()-1) + 1;

		$categories = $categories + Category::orderBy('category_name', 'asc')->get()->lists('category_name', 'id');
		
		$chit = Cookie::queue('chit', Cookie::get('chit'), 60);
		
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
		if(Request::ajax()) {
			$chit = Cookie::queue('chit', Input::all(), 60);
			return Response::json(array('saved'=>date('dS F Y, h:iA')))
				->setCallback(Input::get('callback'));
		}

		echo '<pre>';
		dd(Input::all());
		// $rules = array();

		// $validator = Validatore::make(Input);
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