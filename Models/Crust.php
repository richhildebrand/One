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

	public function GetId()
	{
		$crustRepository = new CrustRepository();
		return $crustRepository->GetIdFromName($this->_name);
	}

	public function GetPrice()
	{
		$crustRepository = new CrustRepository();
		return $crustRepository->GetCrustPrice($this->_name);
	}

	public static function IsValidCrust($name)
	{
		$crustRepository = new CrustRepository();
		return $crustRepository->CrustExists($name);
	}

	public static function GetAllValidCrustsIncludingPrices()
	{
		$crustRepository = new CrustRepository();
		return $crustRepository->GetAllCrusts();
	}
}