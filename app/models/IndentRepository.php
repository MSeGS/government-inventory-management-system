<?php
class IndentRepository implements IndentInterface
{
	public function all()
	{
		return Indent::all()->toArray();
	}

	public function get($id)
	{
		return Indent::with('items', 'requirements', 'indentor', 'indentor.department')->find($id);
	}
}