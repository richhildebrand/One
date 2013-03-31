<?php

class HistoryTemplateBuilder 
{
	private $_orderRepository;
	private $_pizzaRepository;
	private $_toppingRepository;
	private $_crustRepository;

	public function __construct()
	{
		$this->_orderRepository = new OrderRepository();
		$this->_pizzaRepository = new PizzaRepository();
		$this->_toppingRepository = new ToppingRepository();
		$this->_crustRepository = new CrustRepository();
	}

	public function BuildAllOrders($userName)
	{
		$customerNumber = $this->_orderRepository->GetCustomerNumber($userName);
		$orderNumbers = $this->_orderRepository->GetAllCustomerOrders($customerNumber);

		$orders = array();
		foreach ($orderNumbers as $orderNumber)
		{
			$order = new Order();

			$this->GetPizzas($orderNumber['id'], $order);
			array_push($orders, $order);
		}

		return $orders;
	}

	public function GetPizzas($orderNumber, $order)
	{
		$pizzaNumbers = $this->_pizzaRepository->GetAllPizzasForOrder($orderNumber);

		foreach ($pizzaNumbers as $pizzaNumber)
		{
			$pizza = new Pizza();

			$this->GetCrust($pizzaNumber['id'], $pizza);
			$this->GetToppings($pizzaNumber['id'], $pizza);

			$order->PushPizza($pizza);
		}

	}

	public function GetCrust($pizzaNumber, $pizza)
	{
		$crustId = $this->_pizzaRepository->GetCrustId($pizzaNumber['id']);
		$crustName = $this->_crustRepository->GetNameFromId($crustId);

		$pizza->SetCrust($crustName['description']);
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