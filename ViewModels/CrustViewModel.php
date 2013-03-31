<?php

class CrustViewModel
{
	private $description;
	private $price;

	public function __construct($description, $price)
	{
		$this->_description = $description;
		$this->_price = $price;
	}

	public function GetName()
	{
		return $this->_description;
	}

	public function GetPrice()
	{
		return $this->_price;
	}
}