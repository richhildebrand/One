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

    public function GetToppingDetails($toppingId)
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM toppings WHERE id = :toppingId');
        $preparedStatement->execute(array(':toppingId' => $toppingId));

        return $preparedStatement->fetch();
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

    public function AddNewTopping($description, $price)
    {
            $preparedStatement = $this->_dbConnection->prepare('INSERT INTO toppings(description, price)
                                                                VALUES(:description, :price)');
            $preparedStatement->execute(array(':description' => $description,':price' => $price ));
    }

    public function RemoveTopping($id)
    {   
            $preparedStatement = $this->_dbConnection->prepare('DELETE FROM toppings WHERE id = :id');
            $preparedStatement->execute(array(':id' => $id));
    }

    public function UpdateTopping($id, $description, $price)
    {
            $preparedStatement = $this->_dbConnection->prepare('UPDATE toppings 
                                                                SET description = :description,
                                                                    price = :price
                                                                 WHERE id = :id');
            $preparedStatement->execute(array(':id' => $id,':price' => $price, ':description' => $description));
    }
}