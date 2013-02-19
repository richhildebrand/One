<?php
require_once("Topping.php");
require_once("Crust.php");
require_once("Logger.php");

class Pizza {

	private $DEFAULT_CRUST = 'thin';
	private $_toppings;
	private $_crust;

	public function __construct()
	{
		$this->_toppings = array();
		$this->_crust = $this->DEFAULT_CRUST;
	}

	public function SetToppings( $toppings = array() )
	{
		$this->_toppings = array();
		foreach ($toppings as $topping)
		{
			if (Topping::IsValidateTopping($topping))
			{
				array_push($this->_toppings, new Topping($topping));
			}	
		}
	}

	public function SetCrust( $crust )
	{
		$log = new Logger();
		$log->write($crust);
		$log->write("Is valid crust " . Crust::IsValidCrust($crust));
		if (Crust::IsValidCrust($crust))
		{
			$this->_crust = new Crust($crust);
		}
		else
		{
			$this->_crust = new Crust($this->DEFAULT_CRUST);
		}
	}

	public function HasThisCrust( $crust )
	{
		return $this->_crust === $crust;
	}

	public function HasThisTopping( $topping )
	{
		return in_array($topping, $this->_toppings);
	}

	public function GetToppings() {
		return $this->_toppings;
	}

	public function GetCrust() {
		return $this->_crust;
	}

	public function GetPrice()
	{
		$price = $this->_crust->GetPrice();
		foreach ($this->_toppings as $topping) {
			$price += $topping->GetPrice();
		}
		return $price;
	}
}