<?php    
    require_once("../Helpers/ForceHTTPS.php");
    require_once( "../Web.config" );
    require_once("../Helpers/SecureSession.php");
    require_once("../Controllers/OrderController.php");


    if (!isset($_SESSION['Order'])) { $_SESSION['Order'] = new Order(); }
    $order = $_SESSION['Order'];

    unset( $_SESSION['Pizza']);
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
          <?php DisplayPizzasIncludingToppings( $order ); ?>
          <button name="NavigateToAddPizza">order another</button>
          <button name="ClearOrder">checkout</button>
        </form>
    </body>
</html>


<?php

// Template For Displaying Pizzas
function DisplayPizzasIncludingToppings($order) {
    $orderPrice = 0;
    print("<ul>");
        foreach ($order->GetPizzas() as $itemNumber => $pizza) {
            $pizzaPrice = 0;
            print("<li>");
            print("<ul>");
                 foreach ($pizza->GetCrust() as $crust => $price) {
                    $pizzaPrice += $price;
                    print("<li>");
                    print("<span>" . $crust . " crust </span>");
                    print("<span class='price'>" . $price . " </span>");
                    print("</li>");
               }
               
                   foreach ($pizza->GetToppings() as $topping => $price) {
                      $pizzaPrice += $price;
                      print("<li>");
                        print("<span>" . $topping . " </span>");
                        print("<span class='price'>" . $price . " </span>");
                      print("</li>");
                   }
              print("<li>");
                print("<span>Total Price of Pizza is </span><span class='price'>" . $pizzaPrice . "</span>");
                print("<button class='inline' name='" . $itemNumber . "'>update</button>");
                print("<button class='inline' name='DeleteItem' value='" . $itemNumber . "'>remove</button>");
              print("</li>");
            print("</ul>");
            $orderPrice += $pizzaPrice;
            print("</li>");
        }   
    print("</ul>");
    print("<span>Total Price of Order is </span><span class='price'>" . $orderPrice . "</span>");
}
    
?>