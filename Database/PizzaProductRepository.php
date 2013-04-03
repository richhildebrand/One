<?php

class PizzaProductRepository
{
	private $_dbConnection;

	public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function SaveProduct($pizzaId, $type, $description, $price)
    {
        $preparedStatement = $this->_dbConnection->prepare('INSERT INTO pizza_products(pizza_id, type, description, price)
                                                            VALUES(:pizzaId, :type, :description, :price)');
        $preparedStatement->execute(array(':pizzaId' => $pizzaId, ':type' => $type, ':description' => $description, ':price' => $price ));
    }
}