<?php

class HomeController extends BaseController {

	public function index()
	{
		if(Sentry::check()) {
			$admin = Sentry::findGroupByName('Administrator');
			$indentor = Sentry::findGroupByName('Indentor');
			$storekeeper = Sentry::findGroupByName('Store Keeper');

			if($this->current_user->isSuperUser()) {
				$counts = DB::select(DB::Raw(
					"SELECT 
						( SELECT COUNT(*) FROM (SELECT id FROM stores ) as stores ) 
						AS storesCount, 
						( SELECT COUNT(*) FROM ( SELECT `user_id` FROM `users_groups` WHERE `group_id` = 1 ) as admins ) 
						AS adminsCount,
						( SELECT COUNT(*) FROM (SELECT `user_id` FROM `users_groups` WHERE `group_id` = 2 ) as storekeepers) 
						AS storeKeepersCount,
						( SELECT COUNT(*) FROM (SELECT `user_id` FROM `users_groups` WHERE `group_id` = 3 ) as indentors) 
						AS indentorsCount,
						( SELECT COUNT(*) FROM (SELECT DISTINCT `department_id` FROM `users` WHERE department_id > 0) as departments) 
						AS departmentsCount"
					)
				);

				// $years = array(2014,2015,2015,2016);
				$years = IndentItem::distinct(DB::Raw("YEAR(created_at)"))->lists(DB::Raw('YEAR(created_at)'));
				
				return View::make('home.super')->with(compact('counts','years'));
			}
			elseif($this->current_user->inGroup($admin)) {
				$pendingIndents = Indent::where('status','=','pending_approval')->count();
				$pendingRequirements = Requirement::where('status','=','pending')->count();
				$pendingDamages = Damage::where('status','=','pending')->count();
				$outOfStock = Stock::where('quantity','=','0')->count();
				$years = IndentItem::distinct(DB::Raw("YEAR(created_at)"))->lists(DB::Raw('YEAR(created_at)'));

				return View::make('home.admin', compact('years','pendingIndents','pendingRequirements','pendingDamages','outOfStock'));
			}
			elseif($this->current_user->inGroup($indentor)){
				return View::make('home.indentor');
			}
				elseif($this->current_user->inGroup($storekeeper)){
				return View::make('home.storekeeper');
			}
		}
		else
			return View::make('home.index');
	}

	public function ajaxSuper($type,$option)
	{
		$stores = Store::all();
		$return = array();

		foreach($stores as $key => $store){
			$storeCounts = array();

			$query = "SELECT ".$type."(`indent_date`) as ".$type.", COUNT(`id`) as count FROM `store".$store->id."_indents`";

			if($type == 'month'){
				$query.= " WHERE YEAR(`indent_date`)=".($option?$option:date('Y'));
			}

			$query.= " GROUP BY ".$type."(`indent_date`)";
			
			foreach(DB::Select( DB::raw($query)) as $row){
				$storeCounts[] = array($row->$type, $row->count);
			}
			$return[] = array('label'=>$store->department->name.' ('.$store->store_code.')', 'data' => $storeCounts);
		}

		return Response::json($return);
	}

	public function ajaxAdmin()
	{
		sleep(2);
		$return = array();
		$type = Input::get('type',null);
		if($type == 'year'){
			$year = Input::get('year',null);
			$indentItems = IndentItem::where(DB::Raw('YEAR(created_at)'), '=', $year)->orderBy('created_at')->get();
			$currentProduct = '';
			$tempArray = array();
			foreach($indentItems as $item){
				$tempArray[$item->product->name][] = array(strtotime($item->indent->indent_date) * 1000, $item->quantity);
			}
			foreach($tempArray as $product_name=>$a){
				$return[] = array('label'=>$product_name, 'data'=>$a);
			}
		}

		return Response::json($return);
	}

}