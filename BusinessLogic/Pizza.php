<?php
require_once("Topping.php");
require_once("Crust.php");

class Pizza {

	private $_toppings;
	private $_crust;

	public function __construct()
	{
		$this->_toppings = array();
		$this->_crust = 'thin';
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
		if (Crust::IsValidCrust($crust))
		{
			$this->_crust = new Crust($crust);
		}
		else
		{
			$this->_crust = new Crust('thin');
		}
	}

	public function HasThisCrust( $crust )
	{
		return $this->_crust === $crust);
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
}