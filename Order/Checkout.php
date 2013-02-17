<?php    
    require_once("../Configs/Web.config");
    require_once("../Security/SecureSession.php");
    require_once("OrderController.php");

    if (!isset($_SESSION['Order'])) { $_SESSION['Order'] = new Order(); }
    $order = $_SESSION['Order'];
?>

<html>
    <head>
        <link rel=StyleSheet href="../Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>Checkout with Paul's Pizza Palace</h1>
        <form method="post" action="">
          <?php DisplayPizzasIncludingToppings( $order ); ?>
          <button name="NavigateToAddPizza">Add Another Pizza</button>
          <button name="ClearOrder">Finish</button>
        </form>
    </body>
<html>


<?php

// Template For Displaying Pizzas
function DisplayPizzasIncludingToppings($order) {
    print("<ul>");
        foreach ($order->GetPizzas() as $itemNumber => $pizza) {
           print("<li>");
               foreach ($pizza->GetCrust() as $crust => $price) {
                  print("<span>" . $crust . "</span>");
                  print("<span>" . $price . "</span>");
               }
               print("<button name='" . $itemNumber . "'>Update</button>");
               print("<ul>");
                   foreach ($pizza->GetToppings() as $topping => $price) {
                       print("<li>");
                           print("<span>" . $topping . "</span>");
                           print("<span>" . $price . "</span>");
                       print("</li>");
                   }
                print("</ul>");
           print("</li>");
        }   
    print("</ul>");
}
    
?>