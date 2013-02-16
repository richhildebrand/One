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
        <?php DisplayPizzasIncludingToppings( $order ); ?>

        <form method="post" action="">
          <button name="AddAnoterPizza">Add Another Pizza</button>
          <button name="ClearOrder">Finish</button>
        </finish>
    </body>
<html>


<?php

// Template For Displaying Pizzas
function DisplayPizzasIncludingToppings($order) {
    print("<ul>");
        foreach ($order->GetPizzas() as $pizza) {
           print("<li>");
               print($pizza->GetCrust());
               print("<ul>");
                   foreach ((array)$pizza->GetToppings() as $topping => $price) {
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