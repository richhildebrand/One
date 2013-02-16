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
		$pizza->SetCrust($details['Crust']);
		$pizza->SetToppings($details['Toppings']);
		array_push($this->_pizzas, $pizza);
	}

	public function GetPizzas() {
		return $this->_pizzas;
	}
}