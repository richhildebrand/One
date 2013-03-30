<?php

class CheckoutTemplateBuilder 
{

  function ListAllToppingsOnPizza($pizza)
  {
    foreach ($pizza->GetToppings() as $topping)
    {
      ItemTemplate($topping, $topping->GetPrice());
    }
  }

  function ListCrustOnPizza($pizza)
  {
    ItemTemplate($pizza->GetCrust(), $pizza->GetCrust()->GetPrice());
  }

  function ListPizzaTotal($itemNumber, $pizza)
  {
    PizzaTotalTemplate($itemNumber, $pizza->GetPrice());
  }

  function ListEntireOrder($order)
  {
    foreach ($order->GetPizzas() as $itemNumber => $pizza)
    {
      PizzaTemplate($itemNumber, $pizza);
    }  
  }
}