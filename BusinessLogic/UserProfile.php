<?php

class UserProfile {

	private $_lastname;
	private $_firstname;
	private $_email;
	private $_address;
	private $_city;
	private $_state;
	private $_zip5;
	private $_zip4;

	public function __construct($userProfile) 
	{
		$this->_lastname = $userProfile['lastname'];
		$this->_firstname = $userProfile['firstname'];
		$this->_email = $userProfile['email'];
		$this->_address = $userProfile['address'];
		$this->_city = $userProfile['city'];
		$this->_state = $userProfile['state'];
		$this->_zip5 = $userProfile['zip5'];
		$this->_zip4 = $userProfile['zip4'];
	}

	public function GetLastName() {
		return $this->_lastname;
	}

	public function GetFirstName() {
		return $this->_firstname;
	}

	public function GetEmail() {
		return $this->_email;
	}

	public function GetAddress() {
		return $this->_address;
	}

	public function GetCity() {
		return $this->_city;
	}

	public function GetState() {
		return $this->_state;
	}

	public function GetZip5() {
		return $this->_zip5;
	}

	public function GetZip4() {
		return $this->_zip4;
	}

}