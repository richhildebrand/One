<?php

class PizzaViewModel
{
	private $_toppings;
	private $_crust;
	private $_quantity;
	private $_products;

	public function __construct($crust, $toppings, $products, $quantity)
	{
		$this->_crust = $crust;
		$this->_toppings = $toppings;
		$this->_quantity = $quantity;
		$this->_products = $products;
	}

	public function GetToppings()
	{
		return $this->_toppings;
	}

	public function GetProducts()
	{
		return $this->_products;
	}

	public function GetQuantity()
	{
		return $this->_quantity;
	}

	public function GetCrust()
	{
		return $this->_crust;
	}

	public function GetPrice()
	{
		$price = $this->_crust->GetPrice();
		foreach ($this->_toppings as $topping) {
			$price += $topping->GetPrice();
		}
		foreach ($this->_products as $product) {
			$price += $product->GetPrice();
		}
		return $price * $this->_quantity;
	}
}