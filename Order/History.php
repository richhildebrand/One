<?php
    include_once("../Helpers/CheckoutTemplateBuilder.php");
    include_once("../Models/Order.php");
    include_once("../Helpers/OrderHistoryBuilder.php");
    require_once("../Helpers/ForceHTTPS.php");
    require_once("../Web.config" );
    require_once("../Helpers/SecureSession.php");
    require_once("../Controllers/OrderController.php");
    include_once("../Helpers/FooterHelper.php");


    ini_set('max_execution_time', 90);

    $_orderHistoryBuilder = new OrderHistoryBuilder();
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <title> Paul's Pizza Palace </title>
        <link rel=StyleSheet href="../Frontend/Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>History with Paul's Pizza Palace</h1>
        <form method="post" >
        	<ol>
    			<?php
                $orders = $_orderHistoryBuilder->BuildAllOrders($_SESSION['userName']);
                foreach ($orders as $order)
                {
                  OrderTemplate($order);
                }
           ?>
        	</ol>
        </form>
        <?php FooterHelper::DrawSessionFooter(); ?>
    </body>
</html>


<?php 

// Templates
function OrderTemplate($order)
{
	$_templateBuilder = new CheckoutTemplateBuilder();

	print("<li>");
		print("<ul>");
			$_templateBuilder->ListEntireOrder( $order );
		print("</ul>");
		print("<span>Total Price of Order is </span>");
		print("<span class='price'>");
			print($order->GetPrice());
		print("</span>");
    print("<hr>");
	print("</li>");
}


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
  print("</li>");

  print("<li>");
    print("<span>Total Price of Pizza is </span><span class='price'>" . $price . "</span>");
  print("</li>");
}

?>