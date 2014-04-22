<?php

class ProductController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->beforeFilter('sentry');
	}

	public function index()
	{
		$filter = array(
			'name' 			=> Input::get('name'),
			'category_id'	=> Input::get('category')
			);

		if(Request::ajax()) { 
			$products = Product::where('category_id', '=', $filter['category_id']) 
				->orderBy('name', 'asc') 
				->select('id', 'category_id', 'name') 
				->get(); 
			return Response::json($products); 
		}
		
		$products = Product::where(function($query){
			if(Input::get('name', null))
				$query->where('name', 'LIKE', '%' . Input::get('name') . '%');
			
			if(Input::get('category', null))
				$query->where('category_id', 'LIKE', '%' . Input::get('category') . '%');
		})
		->orderBy('name', 'asc')
		->paginate();	

		$categories = array();
		$index = $products->getPerPage() * ($products->getCurrentPage()-1) + 1;

		$categories = $categories + Category::orderBy('category_name', 'asc')->get()->lists('category_name', 'id');
		return View::make('product.index')	
			->with(array(
				'products' 		=> $products,
				'categories' 	=> $categories,
				'filter'		=> $filter,
				'index'			=> $index,
				'current_page'	=> $products->getCurrentPage(),
				'category'		=> Input::get('category',null),
				'name'			=> Input::get('name',null),
				));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::orderBy('category_name', 'asc')->get()->lists('category_name', 'id');
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
		$rules = array();
		$items = array();
		foreach(Input::get('name') as $k=>$v) {
			$items[] = $k;
			if($k != 0) {
				$rules['name.' . $k ] = 'required';
				$rules['reserved_amount.' . $k ] = 'required';
			}
		}

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::to('product/create')
				->withErrors($validator)
				->withInput(Input::all())
				->with('items', $items);
			}

		else{
			foreach(Input::get('name') as $key => $value) {
				if($key != 0) {
					$products = new Product;
					$products->category_id = Input::get('category.' . $key);
					$products->name = $value;
					$products->description = Input::get('description.' . $key);
					$products->reserved_amount = Input::get('reserved_amount.' . $key);
					$products->save();
				}
			}

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
		$filter = array(
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
		->paginate();

		$categories = array();
		$categories = $categories + Category::orderBy('category_name', 'asc')->get()->lists('category_name', 'id');
		$productById = Product::find($id);
		$index = $products->getPerPage() * ($products->getCurrentPage()-1) + 1;
		return View::make('product.edit')
			->with(array(	'productById'	=> $productById,
							'products' 		=> $products,
							'index'			=> $index,
							'current_page'  => $products->getCurrentPage(),
							'filter'		=> $filter,
							'categories'	=> $categories,
							'category'		=> Input::get('category',null),
							'name'			=> Input::get('name',null),
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
		Session::flash('delete', 'Product trashed');
		return Redirect::to('product');
	}

	public function trash()
	{
		$filter = array(
			'name' 			=> Input::get('name'),
			'category_id'	=> Input::get('category')
			);
		
		$products = Product::onlyTrashed()->where(function($query){
			if(Input::get('name', null))
				$query->where('name', 'LIKE', '%' . Input::get('name') . '%');
			
			if(Input::get('category', null))
				$query->where('category_id', 'LIKE', '%' . Input::get('category') . '%');
		})
		->orderBy('name', 'asc')
		->paginate();

		$categories = array();
		$index = $products->getPerPage() * ($products->getCurrentPage()-1) + 1;

		$categories = $categories + Category::orderBy('category_name', 'asc')->get()->lists('category_name', 'id');
		return View::make('product.trash')	
			->with(array(
				'products' 		=> $products,
				'categories' 	=> $categories,
				'filter'		=> $filter,
				'index'			=> $index,
				'current_page'	=> $products->getCurrentPage(),
				'category'		=> Input::get('category',null),
				'name'			=> Input::get('name',null),
				));	
	}

	public function restore($id){
		$product = Product::onlyTrashed()->find($id);
		$product -> restore($id);

		Stock::withTrashed()->where('product_id','=', $id)->restore();

		return Redirect::to('product/trash')
			->with('message', 'Product Restored');
	}

	public function delete($id){
		$product = Product::withTrashed()->find($id);
		$product -> forceDelete($id);

		Stock::withTrashed()->where('product_id','=', $id)->forceDelete();

		return Redirect::to('product/trash')
			->with('delete', 'Product Permanently Deleted');
	}



}