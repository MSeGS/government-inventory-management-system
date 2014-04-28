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
		$chit_size = Cookie::get('chit_size');
		$chit_size = strlen($chit_size)?$chit_size:0;
		Cookie::queue('chit_size', $chit_size, 60);
		
		return View::make('indent.create')
			->with(array(
				'categories' => $categories,
				'products' => $products,
				'filter' => $filter,
				'index' => $index,
				'chit_size' => $chit_size
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
			$chit = Cookie::queue('chit', Input::all('chit'), 60);
			$chit_size = Cookie::queue('chit_size', Input::get('chit_size'), 60);
			return Response::json(array('saved'=>date('dS F Y, h:iA')))
				->setCallback(Input::get('callback'));
		}

		$rules = array();

		foreach (Input::get('chit') as $key=>$value) {
			$rules['chit.' . $key . '.qty'] = 'required|numeric|min:1';
			$rules['chit.' . $key . '.note'] = 'required_if:chit.' . $key . '.type,request';
		}

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::route('indent.create')
					->withErrors($validator)
					->withInput(Input::all());
		}

		$indent = new Indent;
		$indent->indentor_id = get_current_user_id();
		$indent->indent_date = DB::raw('NOW()');
		$indent->status = 'pending_approval';

		if($indent->save()) {
			foreach(Input::get('chit') as $key=>$item) {
				if($item['type'] == 'indent') {
					$indent_item = new IndentItem;
					$indent_item->indent_id = $indent->id;
					$indent_item->product_id = $item['id'];
					$indent_item->quantity = $item['qty'];
					
					if(isset($item['note']))
						$indent_item->indent_reason = $item['note'];

					$indent_item->save();
				}
				if($item['type'] == 'request') {
					$requirement = new Requirement;
					$requirement->indent_id = $indent->id;
					$requirement->product_id = $item['id'];
					$requirement->quantity = $item['qty'];
					$requirement->status = 'pending';
					$requirement->save();
				}
			}

			// Now reset chit cookies
			Cookie::queue('chit', array(), 60);
			Cookie::queue('chit_size', 0, 60);
			
			return Redirect::route('indent.create')
				->with('message', _('Indent request submitted successfully'));
		}
		else
			return Redirect::route('indent.create')
				->with('error', _('Indent request failed. Please try again.'));
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