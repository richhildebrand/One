<?php
require_once("Logger.php");

class Crust
{
	private static $CRUST_DETAILS = array('thick' => 5, 'thin' => 2);
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
		$log = new Logger();
		$log->write(Crust::$CRUST_DETAILS);
		return array_key_exists($name, Crust::$CRUST_DETAILS);
	}

	public static function GetAllValidCrustsIncludingPrices()
	{
		return Crust::$CRUST_DETAILS;
	}
}