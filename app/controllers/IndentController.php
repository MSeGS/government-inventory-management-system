<?php

class IndentController extends \BaseController {

	public function __construct(IndentInterface $indent)
	{
		parent::__construct();
		$this->beforeFilter('sentry');
		$this->indent = $indent;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = array(
			'limit' 			=> Input::get('limit', get_setting('item_per_page'))
			// 'name' 			=> Input::get('name'),
			// 'category_id'	=> Input::get('category')
		);

		$indents = Indent::with('indentor', 'items')
			->orderBy('indent_date', 'desc')
			->paginate($filter['limit']);

		return View::make('indent.index', compact('indents'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function mine()
	{
		$status = array(
			'' => 'All Status',
			'pending_approval' => 'Pending Approval',
			'dispatched' => 'Dispatched',
			'approved' => 'Approved',
			'rejected' => 'Rejected',
			'partial_dispatched' => 'Partial Dispatched',
			);
		$filter = array(
			'limit' => Input::get('limit', get_setting('item_per_page')),
			'indent_date' => Input::get('indent_date'),
			'status' => Input::get('status')
		);

		$indents = Indent::with('indentor', 'items')
			->where(function($query){
				$user = Sentry::getUser();
				$query->where('indentor_id', '=', $user->id);
			})
			->orderBy('indent_date', 'desc')
			->paginate($filter['limit']);

		return View::make('indent.mine', compact('indents', 'filter', 'status'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$filter = array(
			'limit' 		=> Input::get('limit', get_setting('item_per_page')),
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
		

		$chit = is_array(Cookie::get('chit'))?Cookie::get('chit'):array('indent'=>array(), 'requirement'=>array());
		Cookie::queue('chit', $chit, 60);
		$chit_size = is_array(Cookie::get('chit_size'))?Cookie::get('chit_size'):array('indent'=>0, 'requirement'=>0);
		Cookie::queue('chit_size', $chit_size, 60);
		
		return View::make('indent.create')
			->with(array(
				'categories' => $categories,
				'products' => $products,
				'filter' => $filter,
				'index' => $index,
				'chit_size' => $chit_size,
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
			$chit = Cookie::queue('chit', array('indent'=>Input::get('indent'), 'requirement'=>Input::get('requirement')), 60);
			$chit_size = Cookie::queue('chit_size', Input::get('chit_size'), 60);
			
			return Response::json(array('saved'=>date('dS F Y, h:iA')))
				->setCallback(Input::get('callback'));
		}

		$rules = array();

		foreach (Input::get('indent', array()) as $key=>$value) {
			$rules['indent.' . $key . '.qty'] = 'required|numeric|min:1';
			$rules['indent.' . $key . '.note'] = 'required_if:indent.' . $key . '.reserved,1';
		}

		foreach (Input::get('requirement', array()) as $key=>$value) {
			$rules['requirement.' . $key . '.qty'] = 'required|numeric|min:1';
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
			$indent->reference_no = 'CHIT/'.date('Ymd').'/'.$indent->id;
			$indent->save();

			foreach(Input::get('indent', array()) as $key=>$item) {
				$indent_item = new IndentItem;
				$indent_item->indent_id = $indent->id;
				$indent_item->product_id = $item['id'];
				$indent_item->quantity = $item['qty'];
				
				if(isset($item['note']))
					$indent_item->indent_reason = $item['note'];
				$indent_item->status = 'pending';
				$indent_item->save();
			}

			foreach(Input::get('requirement', array()) as $key=>$item) {
				$requirement = new Requirement;
				$requirement->indent_id = $indent->id;
				$requirement->product_id = $item['id'];
				$requirement->quantity = $item['qty'];
				$requirement->status = 'pending';
				$requirement->save();
			}

			// Now reset chit cookies
			Cookie::queue('chit', array('indent'=>array(), 'requirement'=>array()), 60);
			Cookie::queue('chit_size', array('indent'=>0, 'requirement'=>0), 60);
			
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
		if($id) {
			$indent = $this->indent->get($id);
			return View::make('indent.show', compact('indent'));
		}
		else
			return Redirect::route('notfound');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$indent = $this->indent->get($id);
		if(in_array($indent->status, array('pending_approval', 'rejected')))
			return View::make('indent.edit', compact('indent'));
		else
			return Redirect::route('denied');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$indent = $this->indent->get($id);

		$rules = array();
		
		foreach ($indent->items as $item) {
			
			$delete = Input::get('indent.'.$item->product->id.'.remove', null);
			if($delete)
				continue;

			$stock = get_product_stock($item->product->id);
			$quantity = Input::get('indent.'.$item->product->id.'.qty');
			$max = "";
			$reserved = false;
			if($stock > 0)
				$max = '|max:' . $stock;
			
			if($stock <= $item->product->reserved_amount && $quantity >= 1)
				$reserved = true;
			else if($stock > $item->product->reserved_amount && $quantity >= 1)
				$reserved = $quantity > ($stock - $item->product->reserved_amount);

			$rules['indent.' . $item->product->id . '.qty'] = 'required|numeric|min:1' . $max;
			if($reserved)
				$rules['indent.' . $item->product->id . '.note'] = 'required';
		}

		foreach ($indent->requirements as $item) {
			$delete = Input::get('requirement.'.$item->product->id.'.remove', null);
			if($delete)
				continue;

			$rules['requirement.' . $item->product->id . '.qty'] = 'required|numeric|min:1';
		}
		
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::route('indent.edit', $indent->id)
					->withErrors($validator)
					->withInput(Input::all());
		}


		foreach ($indent->items as $item) {
			$delete = Input::get('indent.'.$item->product->id.'.remove', null);
			if($delete) {
				IndentItem::destroy($item->id);
				continue;
			}

			$indent_item = IndentItem::find($item->id);
			$indent_item->quantity = Input::get('indent.'.$item->product->id.'.qty', $item['qty']);
			$indent_item->indent_reason = Input::get('indent.'.$item->product->id.'.note', $item['note']);
			$indent_item->save();
		}
		foreach ($indent->requirements as $item) {
			$delete = Input::get('requirement.'.$item->product->id.'.remove', null);
			if($delete) {
				Requirement::destroy($item->id);
				continue;
			}

			$requirement = Requirement::find($item->id);
			$requirement->quantity = Input::get('requirement.'.$item->product->id.'.qty', $item['qty']);
			$requirement->save();
		}

		return Redirect::route('indent.edit', $indent->id)
					->with('message', _('Indent updated successfully'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!in_array($indent->status, array('pending_approval', 'rejected')))
			return Redirect::route('denied');

		if($indent = Indent::find($id)) {
			$indent->items()->delete();
			$indent->requirements()->forceDelete();
			$indent->forceDelete();

			if($this->current_user->hasAccess('indent.mine')) {
				return Redirect::route('indent.mine')
							->with('message', _('Indent deleted successfully'));
			}
			return Redirect::route('indent.index')
							->with('message', _('Indent deleted successfully'));
		}

		return Redirect::route('indent.index')
							->with('error', _('Indent not deleted. Record not found.'));
	}

	public function process($id)
	{
		$indent = $this->indent->get($id);

		if(in_array($indent->status, array('dispatched', 'partial_dispatched')))
			return Redirect::route('denied');
		else
			return View::make('indent.process', compact('indent'));
	}

	public function postProcess($id)
	{
		$indent = $this->indent->get($id);

		$rules = array();
		
		foreach ($indent->items as $item) {
			$quantity = Input::get('indent.'.$item->product->id.'.qty');
			$stock = get_product_stock($item->product->id);
			$max = "";
			$reserved = false;
			if($stock > 0)
				$max = '|max:' . $stock;
			
			$rules['indent.' . $item->product->id . '.qty'] = 'required|numeric|min:1' . $max;
			$rules['indent.' . $item->product->id . '.reject_reason'] = 'required_if:indent.' . $item->product->id . '.status,rejected';
		}

		foreach ($indent->requirements as $item) {
			$rules['requirement.' . $item->product->id . '.qty'] = 'required|numeric|min:1';
			$rules['requirement.' . $item->product->id . '.reason'] = 'required_if:requirement.' . $item->product->id . '.status,rejected';
		}
		
		$validator = Validator::make(Input::all(), $rules);
		
		if($validator->fails()) {
			return Redirect::route('indent.process', $indent->id)
					->withErrors($validator)
					->withInput(Input::all());
		}

		foreach ($indent->items as $item) {
			$indent_item = IndentItem::find($item->id);
			$indent_item->quantity = Input::get('indent.'.$item->product->id.'.qty', $item['qty']);
			$indent_item->reject_reason = Input::get('indent.'.$item->product->id.'.reject_reason', $item['reject_reason']);
			$indent_item->status = Input::get('indent.'.$item->product->id.'.status', $item['status']);
			$indent_item->save();
		}

		foreach ($indent->requirements as $item) {
			$requirement = Requirement::find($item->id);
			$requirement->quantity = Input::get('requirement.'.$item->product->id.'.qty', $item['qty']);
			$requirement->reason = Input::get('requirement.'.$item->product->id.'.reason', $item['reason']);
			$requirement->status = Input::get('requirement.'.$item->product->id.'.status', $item['status']);
			$requirement->save();
		}

		$indent->status = Input::get('process');
		$indent->save();

		return Redirect::route('indent.process', $indent->id)
				->with('message', _('Indent processed successfully'));
	}

	public function dispatch($id)
	{
		$indent = $this->indent->get($id);

		return View::make('indent.dispatch', compact('indent'));
	}

	public function postDispatch($id)
	{
		$indent = $this->indent->get($id);

		$rules = array();
		
		foreach ($indent->items as $item) {
			$stock = get_product_stock($item->product->id);
			$max = "";
			if($stock > 0)
				$max = '|max:' . $stock;
			if($item->status == 'approved')
				$rules['indent.' . $item->product->id . '.supplied'] = 'required|numeric|min:0' . $max;
		}
		
		$validator = Validator::make(Input::all(), $rules);
		
		if($validator->fails()) {
			return Redirect::route('indent.dispatch', $indent->id)
					->withErrors($validator)
					->withInput(Input::all());
		}

		foreach ($indent->items as $item) {
			$indent_item = IndentItem::find($item->id);
			$indent_item->supplied = Input::get('indent.'.$item->product->id.'.supplied', $item['supplied']);
			$indent_item->save();
		}

		$indent->status = Input::get('dispatch');
		$indent->save();

		return Redirect::route('indent.dispatch', $indent->id)
				->with('message', _('Indent dispatched successfully'));
	}

}