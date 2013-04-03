<?php
include_once("../Helpers/StringHelper.php");

class ProductRepository
{

	private $_dbConnection;

	public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

	public function GetAllProductsOfType($type)
	{
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM products WHERE type = :type');
      	$preparedStatement->execute(array(':type' => $type));

        return $preparedStatement->fetchAll();
	}

    public function GetProductOfType($type)
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM products WHERE type = :type');
        $preparedStatement->execute(array(':type' => $type));

        return $preparedStatement->fetch();
    }

    public function GetProductById($id)
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM products WHERE id = :id');
        $preparedStatement->execute(array(':id' => $id));

        return $preparedStatement->fetch();
    }

	public function AddNewProduct($type, $description, $price)
	{
		if (!StringHelper::AreNullOrEmptyString($type, $description, $price))
		{
	        $preparedStatement = $this->_dbConnection->prepare('INSERT INTO products(type, description, price)
	                                                            VALUES(:type, :description, :price)');
	        $preparedStatement->execute(array(':type' => $type, ':description' => $description,':price' => $price ));
        }
	}

    public function RemoveProduct($id)
    {   
            $preparedStatement = $this->_dbConnection->prepare('DELETE FROM products WHERE id = :id');
            $preparedStatement->execute(array(':id' => $id));
    }

    public function UpdateProduct($id, $type, $description, $price)
    {
    	if (!StringHelper::AreNullOrEmptyString($type, $description, $price))
    	{
            $preparedStatement = $this->_dbConnection->prepare('UPDATE products 
                                                                SET type = :type,
                                                                	description = :description,
                                                                    price = :price
                                                                 WHERE id = :id');
            $preparedStatement->execute(array(':id' => $id, ':type' => $type, ':price' => $price, ':description' => $description));
        }
    }

}