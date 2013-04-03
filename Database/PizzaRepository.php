<?php
include_once( "ToppingRepository.php");
include_once( "PizzaCrustRepository.php");
include_once( "PizzaToppingRepository.php");
include_once( "PizzaProductRepository.php");
require_once( "Database.php" );

class PizzaRepository
{
	private $_toppingRepository;
    private $_crustRepository;
    private $_pizzaCrustRepository;
    private $_pizzaToppingRepository;
    private $_pizzaProductRepository;


    public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->_toppingRepository = new ToppingRepository();
        $this->_crustRepository = new CrustRepository();
        $this->_pizzaCrustRepository = new PizzaCrustRepository();
        $this->_pizzaToppingRepository = new PizzaToppingRepository();
        $this->_pizzaProductRepository = new PizzaProductRepository();
    }

    public function SavePizza( $pizza, $orderId )
    {
        $pizzaId = $this->SavePizzaDetailsAndReturnPizzaId( $orderId, $pizza->GetQuantity());

        $crust = $pizza->GetCrust();
        $crustDescription = $crust->GetName();
        $crustPrice = $crust->GetPrice();
        
        $this->_pizzaCrustRepository->SaveCrust($pizzaId, $crustDescription, $crustPrice);

        foreach ($pizza->GetToppings() as $topping)
        {
            $toppingDescription = $topping->GetName();
            $toppingPrice = $topping->GetPrice();

            $this->_pizzaToppingRepository->SaveTopping($pizzaId, $toppingDescription, $toppingPrice);
        }

        $products = $pizza->GetProducts();
        foreach ($products as $product)
        {
            $type = $product->GetType();
            $description = $product->GetDescription();
            $price = $product->GetPrice();

            $this->_pizzaProductRepository->SaveProduct($pizzaId, $type, $description, $price);
        }

    }

    public function SavePizzaDetailsAndReturnPizzaId( $orderId, $quantity)
    {
        $preparedStatement = $this->_dbConnection->prepare('INSERT INTO pizzas(order_id, quantity)
                                                            VALUES(:orderId, :quantity)');
        $preparedStatement->execute(array(':orderId' => $orderId,':quantity' => $quantity ));

        return $this->_dbConnection->lastInsertId('id');
    }

    public function GetAllPizzasForOrder( $orderNumber )
    {
        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM pizzas WHERE order_id = :orderNumber');
        $preparedStatement->execute(array(':orderNumber' => $orderNumber));

        return $preparedStatement->fetchAll();
    }
}
