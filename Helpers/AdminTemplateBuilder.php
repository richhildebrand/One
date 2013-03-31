<?php
include_once("../Models/Crust.php");
include_once("../Models/Topping.php");

class AdminTemplateBuilder
{

	function ListAllCrusts()
	{
		foreach (Crust::GetAllValidCrustsIncludingPrices() as $crust)
		{
			CrustTemplate($crust['description'], $crust['price'], $crust['id']);
		}
	}

	function ListAllToppings()
	{
		foreach (Topping::GetAllValidToppingsIncludingPrices() as $topping)
		{
			ToppingTemplate($topping['description'], $topping['price'], $topping['id']);
		}
	}
}