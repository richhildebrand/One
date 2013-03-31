<?php
require_once("Pizza.php");

class Order {

	private $_pizzas;

	public function __construct() 
	{
		$this->_pizzas = array();
	}

	public function AddPizza( $pizza, $details ) 
	{
		// use try because isset lies
		$pizza->SetCrust($details['Crust']);
		$pizza->SetToppings($details['Toppings']);
		array_push($this->_pizzas, $pizza);
	}

	public function PushPizza( $pizza )
	{
		array_push($this->_pizzas, $pizza);	
	}

	public function GetPizzas()
	{
		return $this->_pizzas;
	}

	public function GetPizza( $index )
	{
		if (isset($this->_pizzas[$index])) { 
			$temp = $this->_pizzas[$index];
			unset($this->_pizzas[$index]);
			return $temp; 
		 }
	}

	public function DeletePizza( $index )
	{
		if (isset($this->_pizzas[$index]))
		{ 
			unset($this->_pizzas[$index]);
		}
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