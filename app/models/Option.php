<?php
class Option extends Eloquent
{
	protected $table = 'options';
	public $timestamps = false;

	public static function getData($option_key = '')
	{
		$option_data = null;

		if($option_key != '') {
			// First try to fetch from current store setting table
			$setting = Setting::where('option_key', '=', $option_key)->first();
			if(!$setting || ($setting && strlen(trim($setting->option_data)) == 0 ) ) {
				$option = Option::where('option_key', '=', $option_key)->first();
				if($option)
					$option_data = $option->option_data;
			}
			else {
				$option_data = $setting->option_data;
			}
		}

		return $option_data;
	}

	public static function getTitle($option_key = '')
	{
		$option_title = null;

		if($option_key != '') {
			$option = Option::where('option_key', '=', $option_key)->first();
			if($option)
				$option_title = $option->option_title;
		}

		return $option_title;
	}
}