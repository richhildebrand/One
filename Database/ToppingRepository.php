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

}