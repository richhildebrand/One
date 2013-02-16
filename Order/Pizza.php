<?php

class Pizza {

	private $_toppings;
	private $_crust;

	public function __construct()
	{
		$this->_toppings = array();
		$this->_crust = "thin";
	}

	public function SetToppings( $toppings = array() )
	{
		$this->_toppings = array();
		if (isset($toppings['onions'])) { $this->_toppings['onions'] = 2; }
		if (isset($toppings['peppers'])) { $this->_toppings['peppers'] = 3; }
        if (isset($toppings['mushrooms'])) { $this->_toppings['mushrooms'] = 4; }
	}

	public function SetCrust( $crust )
	{
		 if ($crust === 'thick') { $this->_crust = 'thick'; }
		 else { $this->_crust = 'thin'; }
	}

	public function HasThisCrust( $crust )
	{
		return $this->_crust === $crust;
	}

	public function HasThisTopping( $topping )
	{
		return isset($this->_toppings[$topping]) && $this->_toppings[$topping] === true;
	}

	public function GetToppings() {
		return $this->_toppings;
	}

	public function GetCrust() {
		return $this->_crust;
	}
}