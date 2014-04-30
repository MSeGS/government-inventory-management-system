<?php
class IndentRepository implements IndentInterface
{
	public function all()
	{
		return Indent::all()->toArray();
	}

	public function get($id)
	{
		return Indent::with('items', 'requirements')->find($id);
	}
}