<?php
require_once("Pizza.php");

class Order {

	private $_pizzas;

	public function __construct() 
	{
		$this->_pizzas = array();
	}

	public function AddPizza( $pizza ) 
	{
		array_push($this->_pizzas, $pizza);
	}
}