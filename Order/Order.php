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
		try { $pizza->SetCrust($details['Crust']); } catch (Exception $e) {}
		try { $pizza->SetToppings($details['Toppings']); } catch (Exception $e) {}
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
}