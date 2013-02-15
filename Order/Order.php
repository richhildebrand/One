<?php
require_once("pizza.php");

class Order {

	private $_pizzas;

	public function __construct() 
	{
		$this->_pizzas = array();
	}

	public function AddPizza( $pizza ) 
	{
		array_push($_pizzas, $pizza);
	}
}