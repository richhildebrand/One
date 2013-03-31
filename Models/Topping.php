<?php
include_once("../Database/ToppingRepository.php");

class Topping
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

	public function GetId()
	{
		$toppingRepository = new ToppingRepository();
		return $toppingRepository->GetIdFromName($this->_name);
	}


	public function GetPrice()
	{
		$toppingRepository = new ToppingRepository();
		return $toppingRepository->GetToppingPrice($this->_name);
	}

	public static function IsValidateTopping($name)
	{
		$toppingRepository = new ToppingRepository();
		return $toppingRepository->ToppingExists($name);
	}

	public static function GetAllValidToppingsIncludingPrices()
	{
		$toppingRepository = new ToppingRepository();
		return $toppingRepository->GetAllToppings();
	}
}