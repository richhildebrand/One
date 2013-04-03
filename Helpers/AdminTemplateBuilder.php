<?php
include_once("../Models/Crust.php");
include_once("../Models/Topping.php");
include_once("../Database/ProductRepository.php");

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

	function ListAllProducts($type)
	{
		$productRepository = new ProductRepository();
		$products = $productRepository->GetAllProductsOfType($type);

		foreach ($products as $product)
		{
			ProductTemplate($product['description'], $product['price'], $product['id']);
		}
	}
}