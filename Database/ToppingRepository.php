<?php
require_once( "Database.php" );

class ToppingRepository
{
	private $_dbConnection;

	public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function GetIdFromName($toppingName)
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM toppings WHERE description = :description');
        $preparedStatement->execute(array(':description' => $toppingName));

        $result = $preparedStatement->fetch();

        return $result['id'];
    }

    public function SaveTopping($toppingId, $pizzaId)
    {
        $preparedStatement = $this->_dbConnection->prepare('INSERT INTO pizza_toppings(pizza_id, topping_id)
                                                            VALUES(:pizzaId, :topping_id)');
        $preparedStatement->execute(array(':pizzaId' => $pizzaId,':topping_id' => $toppingId ));
    }

    public function GetAllToppings()
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM toppings');
        $preparedStatement->execute();

        return $preparedStatement->fetchAll();
    }

    public function GetToppingPrice($toppingName)
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM toppings WHERE description = :toppingName');
        $preparedStatement->execute(array(':toppingName' => $toppingName));

        $crust = $preparedStatement->fetch();
        return $crust['price'];
    }

    public function ToppingExists($toppingName)
    {
            $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM toppings WHERE description = :toppingName');
            $preparedStatement->execute(array(':toppingName' => $toppingName));

            //sizeof($preparedStatement) is one with zero or more results
            $rowsFound = 0;
            foreach ($preparedStatement as $row)
            {
                $rowsFound += 1;
            }         
            return $rowsFound > 0;
    }
}