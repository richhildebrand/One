<?php
include_once("../Models/Crust.php");

class AdminTemplateBuilder
{

	function ListAllCrusts()
	{
		foreach (Crust::GetAllValidCrustsIncludingPrices() as $crust)
		{
			CrustTemplate($crust['description'], $crust['price'], $crust['id']);
		}
	}

	function ListAllToppings($pizza)
	{
		foreach (Topping::GetAllValidToppingsIncludingPrices() as $topping)
		{
			ToppingTemplate($topping['description'], $topping['price'], $topping['id']);
		}
	}
}