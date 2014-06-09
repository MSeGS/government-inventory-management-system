<?php

class DamageController extends \BaseController
{
	public function __construct()
	{
		parent::__construct();
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

		$categories = Category::orderBy('id','asc')
			->get()
			->lists('category_name','id');
		$categorySelect = array(''=> _('Select Category') , $categories);


		return View::make('damage.index')
			->with(array(
				'damages'=> $damages,
				'categorySelect'=> $categorySelect,
				'categories'=> $categories,
				'cat'=> Input::get('category',null),
				'prodsearch'=> Input::get('prodsearch',null)
				));
	}

	public function trash()
	{
		$filter = array(
			'status' => Input::get('status'),
			);

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

		$categories = Category::orderBy('id','asc')
			->get()
			->lists('category_name','id');
		$categorySelect = array(''=> _('Select Category') ,$categories);

		return View::make('damage.trash')
			->with(array(
				
				'damages'=> $damages,
				'categorySelect'=> $categorySelect,
				'filter' => $filter,
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
			->paginate(1);


		$categories = Category::orderBy('id','asc')
			->get()
			->lists('category_name','id');
		$categorySelect = array(''=> _('All Categories') ,$categories);


		return View::make('damage.manage')
			->with(array(
				'damages'=> $damages,
				'categorySelect'=> $categorySelect,
				'categories'=> $categories,
				'cat'=> Input::get('category',null),
				'prodsearch'=> Input::get('prodsearch',null)			
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

		// Update product stock
		Product::updateInStock($damage->product_id);

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

		if($damage->status == 'declined')
		{
			$currentUser = Sentry::getUser()->id;
			$message = _("Your damage report has been declined by administrator");
			$user =  $damage->user_id;
			Notification::send($currentUser,$user, $message);
		}

		// Update product stock
		Product::updateInStock($damage->product_id);
		
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
		$categories = Category::orderBy('id','asc')
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
		$rules = array(
			'category' 	=> 	'required',
			'product'	=>	'required',
			'quantity'	=>	'required',
			'note'		=>	'required',
			'reported_at'	=>	'required',

			);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator -> fails()) {
			return Redirect::route('damage.create')
				->withErrors($validator)
				->withInput(Input::all());
		}
		else{
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
		return Redirect::route('damage.index');
		
	}

	public function delete($id)
	{
		$damage	= Damage::withTrashed()->find($id);
		$damage->forceDelete();

		Session::flash('delete', _('Product Damage Report Remove Permanently'));
		return Redirect::route('damage.trash');
	}
}