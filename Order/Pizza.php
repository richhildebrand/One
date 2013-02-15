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
		if (isset($toppings['onions'])) { $this->_toppings['onions'] = true; }
		if (isset($toppings['peppers'])) { $this->_toppings['peppers'] = true; }
        if (isset($toppings['mushrooms'])) { $this->_toppings['mushrooms'] = true; }
	}

	public function SetCrust( $crust = array() )
	{
		 if (isset($crust['thick'])) { $this->_crust = "thick"; }
		 else { $this->_crust = "thin"; }
	}

	public function HasThisCrust( $crust )
	{
		return $this->_crust === $crust;
	}

	public function HasThisTopping( $topping )
	{
		return isset($this->_toppings[$topping]) && $this->_toppings[$topping] === true;
	}
}