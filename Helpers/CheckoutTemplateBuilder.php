<?php
include_once("../Models/Order.php");
include_once("../Models/Product.php");

class CheckoutTemplateBuilder 
{

  function ListAllToppingsOnPizza($pizza)
  {
    foreach ($pizza->GetToppings() as $topping)
    {
      ItemTemplate($topping, $topping->GetPrice());
    }
  }

  function ListProductsOfTypeOnPizza($pizza, $type)
  {
    foreach ($pizza->GetProducts() as $product)
    {
      $price = $product->GetPrice();
      $description = $product->GetDescription();

      ProductTemplate($description, $price);
    }
  }

  function ListCrustOnPizza($pizza)
  {
    ItemTemplate($pizza->GetCrust(), $pizza->GetCrust()->GetPrice());
  }

  function ListPizzaTotal($itemNumber, $pizza)
  {
    PizzaTotalTemplate($itemNumber, $pizza->GetPrice(), $pizza->GetQuantity());
  }

  function ListEntireOrder($order)
  {
    foreach ($order->GetPizzas() as $itemNumber => $pizza)
    {
      PizzaTemplate($itemNumber, $pizza);
    }  
  }
}