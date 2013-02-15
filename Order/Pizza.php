<?php

class Pizza {

	private $_toppings;
	private $_crust;

	public function __construct()
	{
		$this->_toppings = array();
		$this->_crust = "thin";
	}

	public function SetToppings( $incommingToppings = array() )
	{
		$this->_toppings = array();
		$this->_newPassword = if isset($incommingToppings['onions']) { this->_toppings['onions'] : 7 };
		$this->_submittedEmail = if isset($incommingToppings['peppers']) { this->_toppings['peppers'] = 2}
        $this->_submittedPassword = if isset($incommingToppings['mushrooms']) {} this->_toppings['mushrooms'] : 5 };
	}

	public function SetCrust( $data = array() )
	{

	}

}