<?php

class StockController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	
	public function __construct()
	{
		$this->beforeFilter('sentry');
		parent::__construct();
	}

	public function index()
	{
		$stocks = Stock::with('product')->orderBy('id', 'desc')->paginate();
		$categories = array( '' => _('Select Category'));
		$categories = $categories + Category::orderBy('category_name', 'asc')
			->get()->lists('category_name','id');
		$index = $stocks->getPerPage() * ($stocks->getCurrentPage()-1) + 1;

		
		return View::make('stock.index')
			->with(array(
				'stocks' 	=> $stocks,
				'categories'=> $categories,
				'index'		=> $index));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$stocks = Stock::with('product')->orderBy('id', 'desc')->paginate();
		$categories = array( '' => _('Select Category'));
		$categories = $categories + Category::orderBy('category_name', 'asc')
			->get()->lists('category_name','id');
		$index = $stocks->getPerPage() * ($stocks->getCurrentPage()-1) + 1;

		
		return View::make('stock.create')
			->with(array(
				'stocks' 	=> $stocks,
				'categories'=> $categories,
				'index'		=> $index));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'product_name'		=> 'required',
			'category_name'		=> 'required',
			'quantity'			=> 'required|integer|min:0'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('stock.create')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
			$stock = new Stock;
			$stock->product_id 		= Input::get('product_name');
			$stock->category_id 	= Input::get('category_name');
			$stock->note 			= Input::get('note');
			$stock->quantity		= Input::get('quantity');
			$stock->save();

			// Update product stock
			Product::updateInStock($stock->product_id);

			return Redirect::route('stock.create')->with('message', 'Stock created successfully');
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
		$stockById = Stock::find($id);
		$stocks = Stock::with('product')->orderBy('id','desc')->paginate(10);
		$products = Product::orderBy('name','asc')
			->get()->lists('name', 'id');
		$categories = Category::orderBy('category_name', 'asc')
			->get()->lists('category_name','id');
		$index = $stocks->getPerPage() * ($stocks->getCurrentPage()-1) + 1;
		return View::make('stock.edit')
			->with(array(
				'stocks' => $stocks,
				'products' => $products,
				'categories'=> $categories,
				'stockById' => $stockById,
				'index'		=> $index
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
			'product_name' => 'required',
			'category_name' => 'required',
			'quantity' => 'required|integer|min:0'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::to('/stock/'. $id. '/edit')
				->withErrors($validator)
				->withInput(Input::all());
		}

		else{
			$stock						= Stock::find($id);
			$stock->category_id			= Input::get('category_name');
			$stock->product_id 			= Input::get('product_name');
			$stock->note 				= Input::get('note');
			$stock->quantity 			= Input::get('quantity');
			$stock->save();

			// Update product stock
			Product::updateInStock($stock->product_id);

			return Redirect::route('stock.index')
				->with('message', _('Successfully updated product stock'));

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
		$stock = Stock::find($id);
		$product_id = $stock->product_id;
		Stock::destroy($id);
		
		// Update product stock
		Product::updateInStock($product_id);

		Session::flash('delete', 'Stock deleted');
		return Redirect::to('stock');
	}
}