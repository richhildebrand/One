<?php

class Pizza {

	private $THIN_CRUST_PRICE = 2;
	private $_toppings;
	private $_crust;

	public function __construct()
	{
		$this->_toppings = array();
		$this->_crust['thin'] = $this->THIN_CRUST_PRICE;
	}

	public function SetToppings( $toppings = array() )
	{
		$this->_toppings = array();
		if (in_array('onions', $toppings)) { $this->_toppings['onions'] = 2; }
		if (in_array('peppers', $toppings)) { $this->_toppings['peppers'] = 3; }
    	if (in_array('mushrooms', $toppings)) { $this->_toppings['mushrooms'] = 4; }
	}

	public function SetCrust( $crust )
	{
		$this->_crust = array();
	 	if ($crust === 'thick') { $this->_crust['thick'] = 5; }
	 	else { $this->_crust['thin'] = $this->_crust['thin'] = $this->THIN_CRUST_PRICE; }
	}

	public function HasThisCrust( $crust )
	{
		return isset($this->_crust[$crust]);
	}

	public function HasThisTopping( $topping )
	{
		return isset($this->_toppings[$topping]);
	}

	public function GetToppings() {
		return $this->_toppings;
	}

	public function GetCrust() {
		return $this->_crust;
	}
}