<?php
include_once( "ToppingRepository.php");
include_once( "PizzaCrustRepository.php");
require_once( "Database.php" );

class PizzaRepository
{
	private $_toppingRepository;
    private $_crustRepository;
    private $_pizzaCrustRepository;

    public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->_toppingRepository = new ToppingRepository();
        $this->_crustRepository = new CrustRepository();
        $this->_pizzaCrustRepository = new PizzaCrustRepository();
    }

    public function SavePizza( $pizza, $orderId )
    {
        $pizzaId = $this->SavePizzaDetailsAndReturnPizzaId( $orderId, $pizza->GetQuantity());

        $crust = $pizza->GetCrust();
        $crustDescription = $crust->GetName();
        $crustPrice = $crust->GetPrice();
        
        $this->_pizzaCrustRepository->SaveCrust($pizzaId, $crustDescription, $crustPrice);

        foreach ($pizza->GetToppings() as $topping)
        {
            $this->_toppingRepository->SaveTopping($topping->GetId(), $pizzaId);
        }

    }

    public function SavePizzaDetailsAndReturnPizzaId( $orderId, $quantity)
    {
        $preparedStatement = $this->_dbConnection->prepare('INSERT INTO pizzas(order_id, quantity)
                                                            VALUES(:orderId, :quantity)');
        $preparedStatement->execute(array(':orderId' => $orderId,':quantity' => $quantity ));

        return $this->_dbConnection->lastInsertId('id');
    }

    public function GetAllPizzasForOrder( $orderNumber )
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT id FROM pizzas WHERE order_id = :orderNumber');
        $preparedStatement->execute(array(':orderNumber' => $orderNumber));

        return $preparedStatement->fetchAll();
    }

        public function GetAllToppingsIds( $pizzaNumber )
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT topping_id FROM pizza_toppings WHERE pizza_id = :pizzaNumber');
        $preparedStatement->execute(array(':pizzaNumber' => $pizzaNumber));

        return $preparedStatement->fetchAll();
    }

}
