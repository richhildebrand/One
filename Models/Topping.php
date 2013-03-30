<?php
include_once("../Database/ToppingRepository.php");

class Topping
{
	private static $TOPPING_DETAILS = array('onions' => 2, 'peppers' => 3, 'mushrooms' => 4);
	private $_toppingRepository;
	private $_name;

	public function __construct($name)
	{
		//$this->_toppingRepository = new ToppingRepository();
		$this->_name = $name;
	}

	public function GetName()
	{
		return $this->_name;
	}

	public function GetId()
	{
		$toppingRepository = new ToppingRepository();
		return $toppingRepository->GetIdFromName($this->_name);
	}


	public function GetPrice()
	{
		return Topping::$TOPPING_DETAILS[$this->_name];
	}

	public static function IsValidateTopping($name)
	{
		return array_key_exists($name, Topping::$TOPPING_DETAILS);
	}

	public static function GetAllValidToppingsIncludingPrices()
	{
		return Topping::$TOPPING_DETAILS;
	}
}