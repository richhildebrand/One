<?php    
    require_once("../Helpers/ForceHTTPS.php");
    require_once( "../Web.config" );
    require_once("../Helpers/SecureSession.php");
    require_once("../Controllers/OrderController.php");

    if (!isset($_SESSION['Order'])) { $_SESSION['Order'] = new Order(); }
    $order = $_SESSION['Order'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <title> Paul's Pizza Palace </title>
        <link rel=StyleSheet href="../Frontend/Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>Checkout with Paul's Pizza Palace</h1>
        <form method="post" >
          <ul>
            <?php ListEntireOrder( $order ); ?>
          </ul>
          <span>Total Price of Order is </span>
          <span class='price'><?php print($order->GetPrice()); ?></span>

          <button name="NavigateToAddPizza">order another</button>
          <button name="ClearOrder">checkout</button>
        </form>
    </body>
</html>


<?php

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

// Templates
function ItemTemplate($item, $price)
{
  print("<li>");
    print("<span>" . $item->GetName() . " </span>");
    print("<span class='price'>" . $price . " </span>");
  print("</li>");
}

function PizzaTotalTemplate($itemNumber, $price)
{
  print("<li>");
    print("<span>Total Price of Pizza is </span><span class='price'>" . $price . "</span>");
    print("<button class='inline' name='EditItem' value='" . $itemNumber . "'>update</button>");
    print("<button class='inline' name='DeleteItem' value='" . $itemNumber . "'>remove</button>");
  print("</li>");
}

function PizzaTemplate($itemNumber, $pizza) 
{
  print("<li>");
    print("<ul>");
          ListCrustOnPizza($pizza);
          ListAllToppingsOnPizza($pizza);
          ListPizzaTotal($itemNumber, $pizza);
    print("</ul>");
  print("</li>");
}

?>

