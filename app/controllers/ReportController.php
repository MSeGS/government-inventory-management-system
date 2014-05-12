<?php
class ReportController extends \BaseController
{
	public function __construct()
	{
		parent:: __construct();
	}

	public function super()
	{
		$department_model = new Department;
		$department_table = $department_model->getTable();
		$stores = Store::join($department_table, $department_table.'.id', '=', 'department_id')
			->orderBy('name', 'asc')->paginate();

		return View::make('report.super', compact('stores'));
	}

	public function product()
	{

		// $dispatched = Indent::where('status','=', 'dispatched')->get();
		$products = Product::orderBy('name', 'asc')->get();                                                                                                      
		return View::make('report.product', compact('products'));
	}

	public function user($graphic = false)
	{
		$reports = Report::user($this->current_user->store_id);

		// $userGroups = User::where('department_id','=',$this->current_user->department_id)->groupBy()
		$userGroupsArray = Report::groupCount($this->current_user);
		$userGroups = $userGroupsArray[0];
		
		return View::make('report.user', compact('reports','userGroups'));
	}

	public function userGraphic()
	{
		$years = array(2014,2015);
		return View::make('report.user-graphic',compact('years','reports','userGroups'));
	}

	public function userDetail($id=null, $year=null)
	{
		$indentors = User::indentors()->lists('full_name','id');
		$years = Indent::select(DB::Raw('YEAR(`indent_date`) as year'))->lists('year','year');

		if($id){
			// $user_exist = true;
			$indents = Indent::where('indentor_id','=',$id);
			if($year)
				$indents = $indents->where(DB::Raw('YEAR(`indent_date`)'),'=',$year);

			$indents = $indents->get();
			$user = User::find($id);
		}else{
			// $user_exist = false;
			$user = false;
			$indents = false;
		}

		return View::make('report.user-detail',compact('user_exist','indentors','user','indents','year','years'));
	}

	public function overview()
	{
		# code...
	}

	public function adminAjax()
	{
		$type = Input::get('type');
		$data = array();
		$extra = array();

		if($type == 'indent'){
			$year = Input::get('year');
			$indents = Report::getUserIndents($year);

			foreach( $indents as $indent){
				$data[$indent->indentor->id]['label'] = $indent->indentor->full_name;
				$data[$indent->indentor->id]['indentor_id'] = $indent->indentor_id;
				$item_count = 0;
				$products = array();
				foreach($indent->items as $i){
					$item_count+=$i->supplied;
					$products[] = array('name'=>$i->product->name,'qty'=>$i->supplied);
				}
				$unix_time = strtotime($indent->indent_date);
				$data[$indent->indentor->id]['data'][] = array($unix_time * 1000,$item_count);
				$extra[$unix_time]['products'] = $products;
				if(!isset($extra[$unix_time]['date']))
					$extra[$unix_time]['date'] = date('Y m d',$unix_time);
			}
		}
		$data = array_values($data);
		if(count($data))
			return Response::json(array('status'=>'success','plotData'=>$data, 'extra'=>$extra));
		else
			return Response::json(array('status'=>'fail'));

	}
} 