<?php

class ProductController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::orderBy('name', 'asc')->paginate(30);
		$categories = array('' => _('Select Category'));
		$categories = $categories + Category::orderBy('category_name', 'asc')->get()->lists('category_name', 'id');
		return View::make('product.index')
			->with(array(
				'products' => $products,
				'categories' => $categories
				));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = array('' => _('Select Category'));
		$categories = $categories + Category::orderBy('category_name', 'asc')->get()->lists('category_name', 'id');
		return View::make('product.create')
			->with(array(
				'categories' => $categories
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
				'category' 					=> 'required',
				'name' 						=> 'required',
				'reserved_amount'			=> 'required|integer'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::to('product/create')
				->withErrors($validator)
				->withInput(Input::all());
			}

		else{
			$products 					= new Product;
			$products->category_id 		= Input::get('category');
			$products->name 			= Input::get('name');
			$products->description 		= Input::get('description');
			$products->reserved_amount	= Input::get('reserved_amount');
			$products->save();

			return Redirect::to('product')
				->with('message', _('New product added successfully'));
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
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$productById = Product::find($id);
		$products    = Product::with('category')->orderBy('name', 'asc')->paginate(20);
		return View::make('product.edit')
			->with(array('productById'=> $productById, 'products' => $products));
		
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
			'name' => 'required',
			'reserved_amount' => 'required|integer|min:0'
			);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::to('/product/'. $id. '/edit')
				->withErrors($validator)
				->withInput(Input::all());
		}

		else{
			$product					= Product::find($id);
			$product->name				= Input::get('name');
			$product->description 		= Input::get('description');
			$product->reserved_amount 	= Input::get('reserved_amount');
 			$product->save();

			Session::flash('message', 'Successfully edited');
			return Redirect::to('/product');

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
		Product::destroy($id);
		Stock::where('product_id','=', $id)->delete();
		Session::flash('delete', 'Product deleted');
		return Redirect::to('product');
	}

}