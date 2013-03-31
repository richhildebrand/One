<?php

class PizzaCrustRepository
{
	private $_dbConnection;
	private $_crustRepository;

    public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->_crustRepository = new CrustRepository();
    }

    public function GetCrustDetails( $pizzaNumber )
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM pizza_crusts WHERE pizza_id = :pizzaNumber');
        $preparedStatement->execute(array(':pizzaNumber' => $pizzaNumber));

        return $preparedStatement->fetch();
    }

    public function SaveCrust($pizzaId, $description, $price)
    {
        $preparedStatement = $this->_dbConnection->prepare('INSERT INTO pizza_crusts(pizza_id, description, price)
                                                            VALUES(:pizzaId, :description, :price)');
        $preparedStatement->execute(array(':pizzaId' => $pizzaId,':description' => $description, ':price' => $price ));
    }
}