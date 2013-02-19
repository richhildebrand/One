<?php

class Crust
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
		if ($this->_name ==='thick') { return 5; }
		if ($this->_name ==='thin') { return 2; }
	}

	public static function IsValidateTopping()
	{
		if ($this->_name === 'thin' or $this->_name === 'thick')
		{
			return true;
		}
		else
		{ 
			return false; 
		}
	}
}