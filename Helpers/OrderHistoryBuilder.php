<?php
include_once("../ViewModels/CrustViewModel.php");
include_once("../ViewModels/PizzaViewModel.php");
include_once("../ViewModels/OrderViewModel.php");
include_once("../ViewModels/ToppingViewModel.php");

class OrderHistoryBuilder 
{
	private $_orderRepository;
	private $_pizzaRepository;
	private $_toppingRepository;
	private $_crustRepository;
	private $_pizzaCrustRepository;
	private $_pizzaToppingRepository;
	private $_pizzaProductRepository;

	public function __construct()
	{
		$this->_orderRepository = new OrderRepository();
		$this->_pizzaRepository = new PizzaRepository();
		$this->_toppingRepository = new ToppingRepository();
		$this->_crustRepository = new CrustRepository();
		$this->_pizzaCrustRepository = new PizzaCrustRepository();
		$this->_pizzaToppingRepository = new PizzaToppingREpository();
		$this->_pizzaProductRepository = new PizzaProductRepository();
	}

	public function BuildAllOrders($userName)
	{
		$customerNumber = $this->_orderRepository->GetCustomerNumber($userName);
		$orderNumbers = $this->_orderRepository->GetAllCustomerOrders($customerNumber);

		$orders = array();
		foreach ($orderNumbers as $orderNumber)
		{
			$pizzas = $this->GetPizzas($orderNumber['id']);
			$order = new OrderViewModel($pizzas);

			array_push($orders, $order);
		}

		return $orders;
	}

	public function GetPizzas($orderNumber)
	{
		$pizzaNumbers = $this->_pizzaRepository->GetAllPizzasForOrder($orderNumber);

		$pizzas = array();
		foreach ($pizzaNumbers as $pizzaNumber)
		{
			$pizzaId = $pizzaNumber['id'];
			$pizzaQuantity = $pizzaNumber['quantity'];

			$crust = $this->GetCrust($pizzaId);
			$toppings = $this->GetToppings($pizzaId);
			$products = $this->GetProducts($pizzaId);

			$pizza = new PizzaViewModel($crust, $toppings, $products, $pizzaQuantity);

			array_push($pizzas, $pizza);
		}

		return $pizzas;
	}

	public function GetCrust($pizzaNumber)
	{
		$crustDetails = $this->_pizzaCrustRepository->GetCrustDetails($pizzaNumber);
		$crust = new CrustViewModel($crustDetails['description'], $crustDetails['price']);
		return $crust;
	}

	public function GetProducts($pizzaNumber)
	{
		$productDetails = $this->_pizzaProductRepository->GetProductsDetails($pizzaNumber);

		$products = array();
		foreach ($productDetails as $productDetail)
		{
			$product = ProductFactory::CreateProductFromDetails($productDetail);
			array_push($products, $product);
		} 

		return $products;
	}

	public function GetToppings($pizzaNumber)
	{
		$toppingDetials = $this->_pizzaToppingRepository->GetToppingDetails($pizzaNumber);

		$toppings = array();
		foreach ($toppingDetials as $toppingDetail)
		{
			$topping = new ToppingViewModel($toppingDetail['description'], $toppingDetail['price']);

			array_push($toppings, $topping);
		}

		return $toppings;
	}
}