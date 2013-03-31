<?php
include_once("../Models/Crust.php");

class AddPizzaTemplateBuilder
	{

	function ListAllCrusts($pizza)
	{
		foreach (Crust::GetAllValidCrustsIncludingPrices() as $crust)
		{

			$checked = $pizza->HasThisCrust($crust['description']) ? "checked" : "";
			CrustTemplate($crust['description'], $crust['price'], $checked);
		}
	}

	function ListAllToppings($pizza)
	{
		foreach (Topping::GetAllValidToppingsIncludingPrices() as $topping)
		{
			$checked = $pizza->HasThisTopping($topping['description']) ? "checked" : "";
			ToppingTemplate($topping['description'], $topping['price'], $checked);
		}
	}
}