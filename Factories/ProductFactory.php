<?php
include_once("../Database/ProductRepository.php");

class ProductFactory
{
	public static function CreateProductFromId($id)
	{
		$productRepository = new ProductRepository();
		$productDetails = $productRepository->GetProductById($id);

		$newProduct = new Product($productDetails['id'], 
				   $productDetails['type'],
				   $productDetails['description'],
				   $productDetails['price']);

		return $newProduct;
	}

	public static function CreateProductFromDetails($productDetails)
	{
		$newProduct = new Product(null, 
						   $productDetails['type'],
						   $productDetails['description'],
						   $productDetails['price']);

		return $newProduct;

	}

}