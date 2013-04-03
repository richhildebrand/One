<?php
include_once("../Models/Crust.php");
include_once("../Database/ProductRepository.php");

class AddPizzaTemplateBuilder
{
	private $_productRepository;

	public function __construct()
	{
		$this->_productRepository = new ProductRepository();
	}

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

	function ListProductsTypeUsingRadio($pizza, $type)
	{

		$products = $this->_productRepository->GetAllProductsOfType($type);

		foreach ($products as $product)
		{
			$checked = $pizza->HasThisProduct($product['id']) ? "checked" : "";
			RadioProductTemplate($product['id'], $product['description'], $product['price'], $checked);
		}
	}
}