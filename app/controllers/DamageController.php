<?php

class DamageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$damages = Damage::with('product')->orderBy('id', 'asc')->paginate();
		$categories = category::orderBy('id','asc')
			->get()
			->lists('category_name','id');
		$categorySelect = array(''=>'Select Category',$categories);

		$products = Product::orderBy('id', 'asc')
			->get()
			->lists('name','id');
		$productSelect = array(''=>'Select Product Name', $products);

		return View::make('damage.index')
			->with(array(
				'damages'=> $damages,
				'productSelect'=> $productSelect,
				'categorySelect'=> $categorySelect
				));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = category::orderBy('id','asc')
			->get()
			->lists('category_name','id');
		$categorySelect = array(''=>'Select Category') + $categories;

		$products = Product::orderBy('id', 'asc')
			->get()
			->lists('name','id');
		$productSelect = array(''=>'Select Product Name') + $products;

		return View::make('damage.create')
			->with(array(
				'productSelect'=> $productSelect,
				'categorySelect'=> $categorySelect
				));
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$damage = new Damage;
		$damage->product_id = Input::get('product');
		$damage->quantity =	Input::get('quantity');
		$damage->note = Input::get('note');
		$damage->reported_at = date('Y-m-d H:i:s', strtotime(Input::get('reported_at')));
		$damage->status = 'pending';
		$damage->save();

		return Redirect::to('damage')
			->with('message', _('Product Damage Report Submitted Successfully'));
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
		Damage::destroy($id);

		Session::flash('delete', 'Item Deleted');
		return Redirect::to('damage');
	}

}