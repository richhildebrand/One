<?php
include_once("../Database/CrustRepository.php");


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
		return Crust::$CRUST_DETAILS[$this->_name];
	}

	public static function IsValidCrust($name)
	{
		return array_key_exists($name, Crust::$CRUST_DETAILS);
	}

	public static function GetAllValidCrustsIncludingPrices()
	{
		$crustRepository = new CrustRepository();
		return $crustRepository->GetAllCrusts();
	}
}