<?php

class PizzaViewModel
{
	private $_toppings;
	private $_crust;
	private $_quantity;

	public function __construct($crust)
	{
		$this->_crust = $crust;
		$this->_toppings = array();
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
		//$price += add toppings
		$price = $price * $this->_quantity;
		return $price;
	}
}