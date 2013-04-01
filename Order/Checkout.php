<?php    
    include_once("../Helpers/CheckoutTemplateBuilder.php");
    include_once("../Models/Order.php");
    require_once("../Helpers/ForceHTTPS.php");
    require_once( "../Web.config" );
    require_once("../Helpers/SecureSession.php");
    require_once("../Controllers/OrderController.php");
    include_once("../Helpers/FooterHelper.php");

    if (!isset($_SESSION['Order'])) { $_SESSION['Order'] = new Order(); }
    $order = $_SESSION['Order'];

    $_templateBuilder = new CheckoutTemplateBuilder();
    
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
            <?php $_templateBuilder->ListEntireOrder( $order ); ?>
          </ul>
          <span>Total Price of Order is </span>
          <span class='price'><?php print($order->GetPrice()); ?></span>

          <button name="NavigateToAddPizza">order another</button>
          <button name="SaveOrder">checkout</button>
        </form>
        <?php FooterHelper::DrawSessionFooter(); ?>
    </body>
</html>


<?php 

// Templates
function PizzaTemplate($itemNumber, $pizza) 
{
  $_templateBuilder = new CheckoutTemplateBuilder();

  print("<li>");
    print("<ul>");
          $_templateBuilder->ListCrustOnPizza($pizza);
          $_templateBuilder->ListAllToppingsOnPizza($pizza);
          $_templateBuilder->ListPizzaTotal($itemNumber, $pizza);
    print("</ul>");
  print("</li>");
}

function ItemTemplate($item, $price)
{
  print("<li>");
    print("<span>" . $item->GetName() . " </span>");
    print("<span class='price'>" . $price . " </span>");
  print("</li>");
}

function PizzaTotalTemplate($itemNumber, $price, $quantity)
{
  print("<li>");
    print("<span>");
      print("Quantity: " . $quantity);
    print("</span>");
    print("<button class='inline' name='IncreaseItemQuantity' value='" . $itemNumber . "'>+1</button>");
    print("<button class='inline' name='DecreaseItemQuantity' value='" . $itemNumber . "'>-1</button>");

  print("<div>");
    print("<span>Total Price of Pizza is </span><span class='price'>" . $price . "</span>");
    print("<button class='inline' name='EditItem' value='" . $itemNumber . "'>edit</button>");
    print("<button class='inline' name='DeleteItem' value='" . $itemNumber . "'>remove</button>");
  print("</div>");
  print("</li>");
}

?>

