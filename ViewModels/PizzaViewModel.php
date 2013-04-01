<?php

class PizzaViewModel
{
	private $_toppings;
	private $_crust;
	private $_quantity;

	public function __construct($crust, $toppings)
	{
		$this->_crust = $crust;
		$this->_toppings = $toppings;
		$this->_quantity = 1;

	}

	public function GetToppings()
	{
		return $this->_toppings;
	}

	public function GetCrust()
	{
		return $this->_crust;
	}

	public function GetPrice()
	{
		$price = $this->_crust->GetPrice();
		foreach ($this->_toppings as $topping)
		{
			$price += $topping->GetPrice();
		}
		$price = $price * $this->_quantity;
		return $price;
	}
}