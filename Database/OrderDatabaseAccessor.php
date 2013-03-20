<?php
require_once( "Database.php" );

class OrderDatabaseAccessor
{
    private $_dbConnection;

    public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function SaveOrder( $orders )
    {
        $preparedStatement = $this->_dbConnection->prepare('INSERT INTO order(customer, order_date)
                                                     VALUES(:customer, :order_date)');
        $preparedStatement->execute(array(':customer' => 1,':order_date' => new DateTime() ));

        return new UserProfile($result);
    }