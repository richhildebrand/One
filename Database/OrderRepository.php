<?php
include_once( "../Helpers/Logger.php");
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

        $orderId = $this->SaveOrderInfoAndReturnOrderId( $customerId );

        foreach ($order->GetPizzas() as $pizza)
        {
            $this->SavePizza($pizza, $orderId);
        }

        return true;

    }

    public function GetCustomerNumber( $customerEmail )
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM customers WHERE email = :email');
        $preparedStatement->execute(array(':email' => $customerEmail));

        $result = $preparedStatement->fetch();


        return $result['id'];
    }

    public function SaveOrderInfoAndReturnOrderId( $customerId )
    {
        $preparedStatement = $this->_dbConnection->prepare('INSERT INTO orders(customer, order_date)
                                                            VALUES(:customer, :order_date)');
        $preparedStatement->execute(array(':customer' => $customerId,':order_date' => $this->_dateTimeHelper->GetCurrentDate() ));

        $result = $this->_dbConnection->lastInsertId('id');

        return $result['id'];
    }

    public function SavePizza( $pizza, $orderId )
    {
        $logger = new Logger();
        $logger->write("orderId = " . $orderId);

        $details = "details";

        $preparedStatement = $this->_dbConnection->prepare('INSERT INTO pizzas(order_id, details)
                                                            VALUES(:orderId, :details)');
        $preparedStatement->execute(array(':orderId' => $orderId,':details' => $details ));
    }

}