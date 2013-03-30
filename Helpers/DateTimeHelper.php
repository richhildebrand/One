<?php

class DateTimeHelper 
{
	public function GetCurrentDate()
	{
		$date = new DateTime();
		return $date->format('y/m/d');
	}

}
