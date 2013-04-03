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
        <h1>Order Receipt for Paul's Pizza Palace</h1>
        <form method="post" >
       		<h2> Order Id <?php print($_SESSION['orderId']); $_SESSION['orderId'] = null; ?> </h2>
          <ul>
            <?php $_templateBuilder->ListEntireOrder( $order ); ?>
          </ul>
          <span>Total Price of Order is </span>
          <span class='price'><?php print($order->GetPrice());
          						$_SESSION['Order'] = null; ?>
		  </span>
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
          $_templateBuilder->ListProductsOfTypeOnPizza($pizza, 'size');
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

function ProductTemplate($description, $price)
{
  print("<li>");
    print("<span>" . $description . " </span>");
    print("<span class='price'>" . $price . " </span>");
  print("</li>");
}

function PizzaTotalTemplate($itemNumber, $price, $quantity)
{
  print("<li>");
    print("<span>");
      print("Quantity: " . $quantity);
    print("</span>");

  print("<div>");
    print("<span>Total Price of Pizza is </span><span class='price'>" . $price . "</span>");
  print("</div>");
  print("</li>");
}

?>