<?php

class PizzaToppingRepository
{
	private $_dbConnection;
	private $_toppingRepository;

    public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->_toppingRepository = new ToppingRepository();
    }

    public function GetToppingDetails( $pizzaNumber )
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM pizza_toppings WHERE pizza_id = :pizzaNumber');
        $preparedStatement->execute(array(':pizzaNumber' => $pizzaNumber));

        return $preparedStatement->fetchAll();
    }

    public function SaveTopping($pizzaId, $description, $price)
    {
        $preparedStatement = $this->_dbConnection->prepare('INSERT INTO pizza_toppings(pizza_id, description, price)
                                                            VALUES(:pizzaId, :description, :price)');
        $preparedStatement->execute(array(':pizzaId' => $pizzaId,':description' => $description, ':price' => $price ));
    }
}