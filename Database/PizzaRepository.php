<?php
include_once( "ToppingRepository.php");
require_once( "Database.php" );

class PizzaRepository
{
	private $_toppingRepository;
    private $_crustRepository;

    public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->_toppingRepository = new ToppingRepository();
        $this->_crustRepository = new CrustRepository();
    }

    public function SavePizza( $pizza, $orderId )
    {
        $pizzaId = $this->SavePizzaDetailsAndReturnPizzaId( $orderId, $pizza->GetQuantity());

        $crustId = $pizza->GetCrust()->GetId();
        $this->_crustRepository->SaveCrust($crustId, $pizzaId);

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

    public function GetCrustId( $pizzaNumber )
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT crust_id FROM pizza_crusts WHERE pizza_id = :pizzaNumber');
        $preparedStatement->execute(array(':pizzaNumber' => $pizzaNumber));

        return $preparedStatement->fetch();
    }

        public function GetAllToppingsIds( $pizzaNumber )
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT topping_id FROM pizza_toppings WHERE pizza_id = :pizzaNumber');
        $preparedStatement->execute(array(':pizzaNumber' => $pizzaNumber));

        return $preparedStatement->fetchAll();
    }

}
