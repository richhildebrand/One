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
		$log = new Logging();
		$log->writeArray( $details );
		$log->writeArray( $details['Toppings'] );
		$log->write("checking crust isset value in AddPizza = " . isset($details['Crust]']));
		$log->write("checking crust actual value in AddPizza = " . $details['Crust']);
		$pizza->SetCrust($details);
		//$pizza->SetToppings($details);
		//isset($details['Crust]']) ? $pizza->SetCrust($details['Crust']) : $pizza->SetCrust(null);
		isset($details['Toppings']) ? $pizza->SetToppings($details['Toppings']) : $pizza->SetToppings(null);
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