<?php

class DamageController extends \BaseController {
	public function __construct()
	{
		$this->beforeFilter('sentry');
	}

	public function index()
	{
		$product = new Product;
		$damage = new Damage;
		$damages = Damage::join($product->getTable(), $damage->getTable().'.product_id', '=', $product->getTable().'.id')
			->where(function($query){
				$search = Input::get('prodsearch');
				$product = new Product;
				if( strlen($search) > 0 )
					$query->where($product->getTable().'.name', 'LIKE', '%' . $search . '%');

				if(Input::get('category', null))
					$query->where('category_id', '=', Input::get('category'));
			})
			->select(array($damage->getTable().".*", $product->getTable().'.name'))
			->orderBy($damage->getTable().'.id', 'asc')
			->paginate();

		$categories = category::orderBy('id','asc')
			->get()
			->lists('category_name','id');
		$categorySelect = array(''=> _('Select Category') , $categories);


		return View::make('damage.index')
			->with(array(
				'damages'=> $damages,
				'categorySelect'=> $categorySelect,
				'categories'=> $categories
				));
	}

	public function trash()
	{
		$product = new Product;
		$damage = new Damage;
		$damages = Damage::onlyTrashed()->join($product->getTable(), $damage->getTable().'.product_id', '=', $product->getTable().'.id')
			->where(function($query){
				$search = Input::get('prodsearch');
				$product = new Product;
				if( strlen($search) > 0 )
					$query->where($product->getTable().'.name', 'LIKE', '%' . $search . '%');

				if(Input::get('category', null))
					$query->where('category_id', '=', Input::get('category'));
			})
			->select(array($damage->getTable().".*", $product->getTable().'.name'))
			->orderBy($damage->getTable().'.id', 'asc')
			->paginate();

		$categories = category::orderBy('id','asc')
			->get()
			->lists('category_name','id');
		$categorySelect = array(''=> _('Select Category') ,$categories);

		return View::make('damage.trash')
			->with(array(
				
				'damages'=> $damages,
				'categorySelect'=> $categorySelect,
				'categories'=> $categories
				));
	}

	public function manage()
	{
		$product = new Product;
		$damage = new Damage;
		$damages = Damage::join($product->getTable(), $damage->getTable().'.product_id', '=', $product->getTable().'.id')
			->where(function($query){
				$search = Input::get('prodsearch');
				$product = new Product;
				if( strlen($search) > 0 )
					$query->where($product->getTable().'.name', 'LIKE', '%' . $search . '%');

				if(Input::get('category', null))
					$query->where('category_id', '=', Input::get('category'));
			})
			->select(array($damage->getTable().".*", $product->getTable().'.name'))
			->orderBy($damage->getTable().'.id', 'asc')
			->paginate();

		$categories = category::orderBy('id','asc')
			->get()
			->lists('category_name','id');
		$categorySelect = array(''=> _('Select Category') ,$categories);


		return View::make('damage.manage')
			->with(array(
				'damages'=> $damages,
				'categorySelect'=> $categorySelect,
				'categories'=> $categories
				));
	}

	/** 
	* Function for approving the damage
	* report for administrator
	*/
	public function approve($id)
	{
		$damage	= Damage::find($id);
		$damage->status = 'approved';
		$damage->save();

		return Redirect::route('damage.manage')
			->with('message', _('Product Damage Report Successfully Approved'));
	}

	/** 
	* Function for declining the damage
	* report for administrator
	*/
	public function decline($id)
	{
		$damage	= Damage::find($id);
		$damage->status='declined';
		$damage->save();

		return Redirect::route('damage.manage')
			->with('message', _('Product Damage Report Declined'));
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
		$categorySelect = array(''=> _('Select Category')) + $categories;

		$products = Product::orderBy('id', 'asc')
			->get()
			->lists('name','id');
		$productSelect = array(''=> _('Select Product Name')) + $products;

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
		
		$user = Sentry::getUser();
		$damage = new Damage;
		$damage->user_id = $user->id; 
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
		
		$product = new Product;
		$damage = new Damage;
		$current_damage = Damage::find($id);
		$damages = Damage::join($product->getTable(), $damage->getTable().'.product_id', '=', $product->getTable().'.id')
			->select(array($damage->getTable().".*", $product->getTable().'.name'))
			->orderBy($damage->getTable().'.id', 'asc')
			->paginate();

		$products = Product::orderBy('id', 'asc')
			->get()
			->lists('name','id');
		$productSelect = array(''=> _('Select Product Name') , $products);
		
		return View::make('damage.edit')
			->with(array(
				'damages'=> $damages,
				'productSelect'=> $productSelect,
				'current_damage'=>$current_damage
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
		$damage	= Damage::find($id);
		$damage->quantity =	Input::get('quantity');
		$damage->note = Input::get('note');
		$damage->reported_at = date('Y-m-d H:i:s', strtotime(Input::get('reported_at')));
		$damage->save();

		return Redirect::to('damage')
			->with('message', _('Product Damage Report Updated Successfully'));
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

		Session::flash('delete', 'Item Moved to trash');
		return Redirect::to('damage');
	}

	public function restore($id)
	{
		$damage	= Damage::onlyTrashed()->find($id);
		$damage->restore();

		Session::flash('delete', _('Product Damage Report Restored'));
		return Redirect::to('damage');
		
	}

	public function delete($id)
	{
		$damage	= Damage::withTrashed()->find($id);
		$damage->forceDelete();

		Session::flash('delete', _('Product Damage Report Remove Permanently'));
		return Redirect::to('damage');
	}
}