<?php

class Crust
{
	private $CRUST_DETAILS = array('thick' => 5, 'thin' => 2);
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
		return $this->CRUST_DETAILS[$this->_name];
	}

	public static function IsValidateCrust($name)
	{
		return in_array($name, this->CRUST_DETAILS);
	}
}