<?php
require_once("Topping.php");
require_once("Crust.php");

class Pizza {

	private $DEFAULT_CRUST = 'thin';
	private $_toppings;
	private $_crust;
	private $_quantity;
	private $_products;

	public function __construct($products)
	{
		$this->_products = $products;
		$this->_toppings = array();
		$this->_crust = new Crust($this->DEFAULT_CRUST);
		$this->_quantity = 1;

	}

	public function SetToppings( $toppings = array() )
	{
		$this->_toppings = array();
		foreach ($toppings as $topping)
		{
			if (Topping::IsValidateTopping($topping))
			{
				array_push($this->_toppings, new Topping($topping));
			}	
		}
	}

	public function SetCrust( $crust )
	{
		if (Crust::IsValidCrust($crust))
		{
			$this->_crust = new Crust($crust);
		}
		else
		{
			$this->_crust = new Crust($this->DEFAULT_CRUST);
		}
	}

	public function HasThisCrust( $crust )
	{
		return $this->_crust->GetName() == $crust;
	}

	public function HasThisProduct( $idToLookFor )
	{
		foreach ($this->_products as $product) 
		{
			if ($product->GetId() == $idToLookFor) 
			{ 
				return true; 
			}
		}
		return false;
	}

	public function HasThisTopping( $topping )
	{
		foreach ($this->_toppings as $pizzaTopping) 
		{
			if ($pizzaTopping->GetName() == $topping) { return true; }
		}
		return false;
	}

	public function GetToppings() {
		return $this->_toppings;
	}

	public function GetCrust() {
		return $this->_crust;
	}

	public function GetPrice()
	{
		$price = $this->_crust->GetPrice();
		foreach ($this->_toppings as $topping) {
			$price += $topping->GetPrice();
		}
		return $price * $this->_quantity;
	}

	public function GetQuantity()
	{
		return $this->_quantity;
	}

	public function SetQuantity($quantity)
	{
		$this->_quantity = $quantity;
	}
}