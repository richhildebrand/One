<?php

class Topping
{
	private $TOPPING_DETAILS = array('onions' => 2, 'peppers' => 3, 'mushrooms' => 4);
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
		return $TOPPING_DETAILS[$this->_name];
	}

	public static function IsValidateTopping($name)
	{
		return in_array($name, $TOPPING_DETAILS);
	}
}