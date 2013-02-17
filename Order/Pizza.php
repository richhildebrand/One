<?php
require_once("../Logging/Logging.php");

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
		try 
		{ 
			if (in_array('onions', $toppings)) { $this->_toppings['onions'] = 2; }
			if (in_array('peppers', $toppings)) { $this->_toppings['peppers'] = 3; }
        	if (in_array('mushrooms', $toppings)) { $this->_toppings['mushrooms'] = 4; }
    	}
    	catch (Exception $e) {}
	}

	public function SetCrust( $details )
	{
		$this->_crust = 'thin';
		try
		{
			$crust = $details['Crust'];
		 	if ($crust === 'thick') { $this->_crust = 'thick'; }
		}
		catch (Exception $e) {}
	}

	public function HasThisCrust( $crust )
	{
		return $this->_crust === $crust;
	}

	public function HasThisTopping( $topping )
	{
		$log = new Logging();
		$log->write("topping " . $topping . " isset " . isset($this->_toppings[$topping]));
		return isset($this->_toppings[$topping]);
	}

	public function GetToppings() {
		$loger = new Logging();
		$loger->write("toppings count = " . sizeof($this->_toppings));
		$loger->write("at getting toppings onions isset = " . isset($this->_toppings['onions']));
		return $this->_toppings;
	}

	public function GetCrust() {
		return $this->_crust;
	}
}