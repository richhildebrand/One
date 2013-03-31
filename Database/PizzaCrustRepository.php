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

    public function GetCrustId( $pizzaNumber )
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT crust_id FROM pizza_crusts WHERE pizza_id = :pizzaNumber');
        $preparedStatement->execute(array(':pizzaNumber' => $pizzaNumber));

        return $preparedStatement->fetch();
    }

    public function SaveCrust($crustId, $pizzaId)
    {
        if ($this->PizzaHasCrust($crustId, $pizzaId))
        {
            $preparedStatement = $this->_dbConnection->prepare('UPDATE pizza_crusts SET crust_id = :crustId WHERE pizza_id = :pizzaId');
            $preparedStatement->execute(array(':pizzaId' => $pizzaId,':crustId' => $crustId));
        }
        else
        {
            $preparedStatement = $this->_dbConnection->prepare('INSERT INTO pizza_crusts(pizza_id, crust_Id)
                                                                VALUES(:pizzaId, :crustId)');
            $preparedStatement->execute(array(':pizzaId' => $pizzaId,':crustId' => $crustId ));
        }
    }

    public function PizzaHasCrust($crustId, $pizzaId)
    {
            $preparedStatement = $this->_dbConnection->prepare('SELECT crust_id FROM pizza_crusts WHERE pizza_id = :pizzaId');
            $preparedStatement->execute(array(':pizzaId' => $pizzaId));

            //sizeof($preparedStatement) is one with zero or more results
            $rowsFound = 0;
            foreach ($preparedStatement as $row)
            {
                $rowsFound += 1;
            }         
            return $rowsFound > 0;
    }
}