<?php

class StockController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$stocks = Stock::with('product')->orderBy('id', 'desc')->paginate();
		$products = array( '' => _('Select Product'));
		$categories = array( '' => _('Select Category'));
		$products = $products + Product::orderBy('name', 'asc')
			->get()->lists('name','id');
		$categories = $categories + Category::orderBy('category_name', 'asc')
			->get()->lists('category_name','id');
		
		return View::make('stock.index')
			->with(array(
				'stocks' => $stocks,	
				'categories' => $categories,	
				'products' => $products));	
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
			'product_name'		=> 'required',
			'quantity'			=> 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('stock.index')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
				$stock = new Stock;
				$stock->product_id 	= Input::get('product_name');
				$stock->category_id 	= Input::get('product_name');
				$stock->note 		= Input::get('note');
				$stock->quantity	= Input::get('quantity');
				$stock->save();

				return Redirect::route('stock.index')->with('message', 'Store created successfully');
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
		$stocks = Stock::with('product')->orderBy('id','desc')->paginate();
		$products = Product::orderBy('name','asc')
			->get()->lists('name', 'id');
		return View::make('stock.edit')
			->with(array(
				'stocks' => $stocks,
				'products' => $products,
				'stockById' => $stockById
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
			'quantity' => 'required'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::to('/stock/'. $id. '/edit')
				->withErrors($validator)
				->withInput(Input::all());
		}

		else{
			$stock						= Stock::find($id);
			$stock->product_id 			= Input::get('product_name');
			$stock->note 				= Input::get('note');
			$stock->quantity 			= Input::get('quantity');
			$stock->save();

			Session::flash('message', 'Successfully edited');
			return Redirect::to('/stock');

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
		Stock::destroy($id);

		Session::flash('delete', 'Stock deleted');
		return Redirect::to('stock');
	}

}