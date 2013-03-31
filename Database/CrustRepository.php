<?php
require_once( "Database.php" );

class CrustRepository
{
	private $_dbConnection;

	public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function GetIdFromName($crustName)
    {
        include_once("../Helpers/Logger.php");
        $logger = new Logger();
        $logger->write("$crustName = " . $crustName);

        $preparedStatement = $this->_dbConnection->prepare('SELECT id FROM crusts WHERE description = :description');
        $preparedStatement->execute(array(':description' => $crustName));

        $result = $preparedStatement->fetch();

        return $result['id'];
    }

    public function GetNameFromId($crustId)
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT description FROM crusts WHERE id = :crustId');
        $preparedStatement->execute(array(':crustId' => $crustId));

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

    public function GetAllCrusts()
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM crusts');
      	$preparedStatement->execute();

        return $preparedStatement->fetchAll();
    }

    public function GetCrustPrice($crustName)
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM crusts WHERE description = :crustName');
      	$preparedStatement->execute(array(':crustName' => $crustName));

        $crust = $preparedStatement->fetch();
        return $crust['price'];
    }

    public function CrustExists($crustName)
    {
            $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM crusts WHERE description = :crustName');
            $preparedStatement->execute(array(':crustName' => $crustName));

            //sizeof($preparedStatement) is one with zero or more results
            $rowsFound = 0;
            foreach ($preparedStatement as $row)
            {
                $rowsFound += 1;
            }         
            return $rowsFound > 0;
    }
}