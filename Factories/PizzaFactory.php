<?php
include_once("../Database/ProductRepository.php");
include_once("../Models/Product.php");

class PizzaFactory
{
	public static function GetNewPizza() 
	{
		$productRepository = new ProductRepository();
		$sizeDetails = $productRepository->GetProductOfType('size');

		$sizeProduct = new Product($sizeDetails['id'], 
								   $sizeDetails['type'],
								   $sizeDetails['description'],
								   $sizeDetails['price']);

		$products = array();
		array_push($products, $sizeProduct);
		return new Pizza($products);
	}
}