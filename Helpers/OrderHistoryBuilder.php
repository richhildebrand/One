<?php
include_once("../ViewModels/CrustViewModel.php");
include_once("../ViewModels/PizzaViewModel.php");
include_once("../ViewModels/OrderViewModel.php");

class OrderHistoryBuilder 
{
	private $_orderRepository;
	private $_pizzaRepository;
	private $_toppingRepository;
	private $_crustRepository;
	private $_pizzaCrustRepository;

	public function __construct()
	{
		$this->_orderRepository = new OrderRepository();
		$this->_pizzaRepository = new PizzaRepository();
		$this->_toppingRepository = new ToppingRepository();
		$this->_crustRepository = new CrustRepository();
		$this->_pizzaCrustRepository = new PizzaCrustRepository();
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
			$crust = $this->GetCrust($pizzaId);

			$pizza = new PizzaViewModel($crust);

			//$this->GetToppings($pizzaNumber['id'], $pizza);

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

	public function GetToppings($pizzaNumber, $pizza)
	{
		$toppingIds = $this->_pizzaRepository->GetAllToppingsIds($pizzaNumber);

		$toppings = array();
		foreach ($toppingIds as $toppingId)
		{
			$toppingName = $this->_toppingRepository->GetNameFromId($toppingId['topping_id']);
			array_push($toppings, $toppingName['description']);
		}

		$pizza->SetToppings($toppings);
	}
}