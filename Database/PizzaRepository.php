<?php
include_once( "ToppingRepository.php");
require_once( "Database.php" );

class PizzaRepository
{
	private $_toppingRepository;

    public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->_toppingRepository = new ToppingRepository();
    }

    public function SavePizza( $pizza, $orderId )
    {
        $pizzaId = $this->SavePizzaDetailsAndReturnPizzaId( $orderId, $pizza->GetQuantity());

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

}
