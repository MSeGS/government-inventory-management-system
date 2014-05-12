<?php
use Carbon\Carbon;

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
		$months = array(
					'01' 	=> 	'January',
					'02'	=> 	'February',
					'03' 	=> 	'March',
					'04'	=> 	'April',
					'05' 	=> 	'May',
					'06' 	=>	'June',
					'07'	=> 	'July',
					'08' 	=> 	'August',
					'09' 	=> 	'September',
					'10'	=> 	'October',
					'11' 	=> 	'November',
					'12' 	=> 	'December');
		$years = array();
		for($year=2013; $year<=date('Y'); $year++)
			$years[$year] = $year;

		$filter = array(
			'month' 		=> Input::get('month', null),
			'year'			=> Input::get('year', null)
			);

		$products 	= Product::orderBy('name', 'asc')->paginate();
		$index = $products->getPerPage() * ($products->getCurrentPage()-1) + 1;
		return View::make('report.product', compact('products', 'filter', 'months', 'years', 'index'));
	}

	public function productGraphic()
	{
		$years = Indent::select(DB::Raw('YEAR(`indent_date`) as year'))->lists('year','year');
		return View::make('report.product-graphic',compact('years','reports','userGroups'));
	}

	public function productDetail()
	{
		$years = Indent::select(DB::Raw('YEAR(`indent_date`) as year'))->lists('year','year');
		return View::make('report.product-graphic',compact('years','reports','userGroups'));
	}

	public function user()
	{

		$userGroupsArray = Report::groupCount($this->current_user);
		$userGroups = $userGroupsArray[0];
		
		$indentors = User::indentors()->all();
		return View::make('report.user', compact('indentors','userGroups'));
	}

	public function userGraphic()
	{
		$years = Indent::select(DB::Raw('YEAR(`indent_date`) as year'))->lists('year','year');
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

		if($type == 'user'){
			$year = Input::get('year');
			$indents = Report::getUserIndents($year);

			foreach( $indents as $indent){
				$data[$indent->indentor->id]['label'] = $indent->indentor->full_name;
				$data[$indent->indentor->id]['indentor_id'] = $indent->indentor_id;
				$item_count = 0;
				$products = array();
				foreach($indent->items as $i){
					$item_count+=$i->supplied;
					$products[] = array('name'=>$i->product->name,'value'=>$i->supplied);
				}
				$unix_time = strtotime($indent->indent_date);
				$data[$indent->indentor->id]['data'][] = array($unix_time * 1000,$item_count);
				$extra[$unix_time]['items'] = $products;
				if(!isset($extra[$unix_time]['date']))
					$extra[$unix_time]['date'] = date('Y m d',$unix_time);
			}
		}

		if($type == 'product'){
			// echo '<pre>';
			$products = Product::with('items','items.indent')->get();
			foreach ($products as $key => $product) {
				$data[$product->id]['label'] = $product->name;
				$indentors = array();
				// echo '<br /> Product Id';
				// echo $product->id;
				foreach($product->items as $item){
					// echo '<br /> item-id';
					// print_r($item->id);
					// echo '<br /> supplied';
					// echo $item->supplied;
					$unix_time = strtotime(date('Y-m-d',strtotime($item->indent->indent_date)));
					$data[$product->id]['data'][] = array($unix_time * 1000, $item->supplied);
					// $indentors[] = array('name'=>$item->indent->indentor->full_name,'value'=>$item->supplied);
					$extra[$unix_time * 1000]['date'] = date('d-M-y',strtotime($item->indent->indent_date));
					$extra[$unix_time * 1000]['items'][] = array('name'=>$item->indent->indentor->full_name,'value'=>$item->supplied);
				}
				usort($data[$product->id]['data'], 'datasort');
			}
		}
		// exit;
		$data = array_values($data);
		if(count($data))
			return Response::json(array('status'=>'success','plotData'=>$data, 'extra'=>$extra));
		else
			return Response::json(array('status'=>'fail'));

	}
} 
function datasort($a, $b)
	{
		if($a[0] == $b[0])
			return 0;
		return $a[0] > $b[0] ? 1 : -1;
	}
