<?php

class Product
{
	private $_id;
	private $_type;
	private $_description;
	private $_price;

	public function __construct($id, $type, $description, $price)
	{
		$this->_id = $id;
		$this->_type = $type;
		$this->_description = $description;
		$this->_price = $price;
	}

	public function GetId()
	{
		return $this->_id;
	}

	public function GetDescription()
	{
		return $this->_description;
	}

		public function GetPrice()
	{
		return $this->_price;
	}
}