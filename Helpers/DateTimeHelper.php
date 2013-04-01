<?php

class DateTimeHelper 
{
	public function GetCurrentDate()
	{
		date_default_timezone_set('America/New_York');
		$date = new DateTime();
		return $date->format('y/m/d');
	}

}
