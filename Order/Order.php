<?php
require_once("Pizza.php");
require_once("../Logging/Logging.php");

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

	public function GetPizzas()
	{
		return $this->_pizzas;
	}

	public function GetPizza( $index )
	{
		$log = new Logging();
		$log->write("index = " . $index);
		$log->write("isset = " . isset($this->_pizzas[$index]));
		if (isset($this->_pizzas[$index])) { return $this->_pizzas[$index]; }
	}
}