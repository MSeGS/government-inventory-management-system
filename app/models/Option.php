<?php
class Option extends Eloquent
{
	protected $table = 'options';
	public $timestamps = false;

	public static function getData($option_key = '')
	{
		$option_data = null;

		if($option_key != '') {
			$option = Option::where('option_key', '=', $option_key)->first();
			if($option)
				$option_data = $option->option_data;
		}

		return $option_data;
	}
}