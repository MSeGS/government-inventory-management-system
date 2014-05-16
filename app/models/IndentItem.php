<?php
class IndentItem extends BaseStore
{
	
	protected $table = 'indents_items';


	public function __construct()
	{
		parent::__construct();
	}

	public function indent()
	{
		return $this->hasOne('Indent', 'id', 'indent_id');
	}

	public function product()
	{
		return $this->belongsTo('Product');
	}

	public static function countIndentByIndentByDate($id)
	{
		$indent = new Indent;
		$indentItem = new IndentItem;
		return DB::table($indentItem->getTableName())
            ->join($indent->getTableName(), $indentItem->getTableName().'.indent_id', '=', $indent->getTableName().'.id')
            ->select(DB::Raw('SUM('.$indentItem->getTableName().'.quantity) as qty'), DB::Raw('SUM('.$indentItem->getTableName().'.supplied) as supplied'), DB::Raw('DATE('.$indent->getTableName().'.indent_date) as indent_date') )
            ->groupBy($indent->getTableName().'.indent_date')
            ->where($indentItem->getTableName().'.id','=',$id);
	}

}