<?php
class IndentRepository implements IndentInterface
{
	public function all()
	{
		return Indent::all()->toArray();
	}
}