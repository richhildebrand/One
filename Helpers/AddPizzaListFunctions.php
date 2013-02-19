<?php

function ListAllCrusts($pizza)
{
	foreach (Crust::GetAllValidCrustsIncludingPrices() as $crust => $price)
	{
		$checked = $pizza->HasThisCrust($crust) ? "checked" : "";
		CrustTemplate($crust, $price, $checked);
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