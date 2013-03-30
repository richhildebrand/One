<?php
include_once( "../Helpers/DateTimeHelper.php");
include_once( "../Models/UserProfile.php");
require_once( "Database.php" );

class OrderRepository
{
    private $_dbConnection;
    private $_dateTimeHelper;

    public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->_dateTimeHelper = new DateTimeHelper();

    }

    public function SaveOrder( $order, $email )
    {

        $customerId = $this->GetCustomerNumber($email);


        $preparedStatement = $this->_dbConnection->prepare('INSERT INTO orders(customer, order_date)
                                                     VALUES(:customer, :order_date)');
        $preparedStatement->execute(array(':customer' => $customerId,':order_date' => $this->_dateTimeHelper->GetCurrentDate() ));

        return new UserProfile($result);
    }

    public function GetCustomerNumber( $customerEmail )
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM customers WHERE email = :email');
        $preparedStatement->execute(array(':email' => $customerEmail));

        $result = $preparedStatement->fetch();


        return $result['id'];
    }
}