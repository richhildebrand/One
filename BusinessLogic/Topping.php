<?php

class Topping
{
	private static $TOPPING_DETAILS = array('onions' => 2, 'peppers' => 3, 'mushrooms' => 4);
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
		return Topping::$TOPPING_DETAILS[$this->_name];
	}

	public static function IsValidateTopping($name)
	{
		return in_array($name, Topping::$TOPPING_DETAILS);
	}

	public static function GetAllValidToppingsIncludingPrices()
	{
		return Topping::$TOPPING_DETAILS;
	}
}