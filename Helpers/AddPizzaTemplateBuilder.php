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
		foreach (Topping::GetAllValidToppingsIncludingPrices() as $topping => $price)
		{
			$checked = $pizza->HasThisTopping($topping) ? "checked" : "";
			ToppingTemplate($topping, $price, $checked);
		}
	}
}