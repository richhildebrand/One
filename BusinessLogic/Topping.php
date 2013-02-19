<?php

class Toppings
{
	private $_name;

	public function __construct($name)
	{
		$this->_name = $name;
	}

	public function GetName()
	{
		return $this->_name;
	}

	public function GetPrice()
	{
		if ($this->_name ==='onions') { return 2; }
		if ($this->_name ==='peppers') { return 3; }
		if ($this->_name ==='mushrooms') { return 4; }
	}

	public static function IsValidateTopping()
	{
		if ($this->_name === 'onions' or
			$this->_name === 'peppers' or
			$this->_name === 'mushrooms')
		{
			return true;
		}
		else
		{ 
			return false; 
		}
	}
}