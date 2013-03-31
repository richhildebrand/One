<?php

class OrderViewModel
{
	private $_pizzas;

	public function __construct($pizzas) 
	{
		$this->_pizzas = $pizzas;
	}

	public function GetPizzas()
	{
		return $this->_pizzas;
	}

	public function GetPrice()
	{
		$price = 0;
		foreach ($this->_pizzas as $pizza)
		{
			$price += $pizza->GetPrice();
		}

		return $price;
	}
}