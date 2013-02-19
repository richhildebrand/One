<?php
    require_once("../Helpers/ForceHTTPS.php");
    require_once( "../Web.config" );
    require_once("../Helpers/SecureSession.php");
    require_once("../Controllers/OrderController.php");
    
    if (!isset($_SESSION['Order'])) { $_SESSION['Order'] = new Order(); }
    if (!isset($_SESSION['Pizza'])) { $_SESSION['Pizza'] = new Pizza(); }
    $order = $_SESSION['Order'];
    $pizza = $_SESSION['Pizza'];
    
?>
<!DOCTYPE html>
<html>
    <head>
    	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    	<title> Paul's Pizza Palace </title>
        <link rel=StyleSheet href="../Frontend/Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>Order from Paul's Pizza Palace</h1>
        <form method="post">
        	<label >Choose your crust</label>
        	<?php ListAllCrusts($pizza); ?>

	        <label >Choose your toppings</label>
	        <?php ListAllToppings($pizza); ?>

	        <button name="AddAnoterPizza">Add Another Pizza</button>
			<button name="Checkout">Save Pizza and Checkout</button>
    	</form>
	</body>
</html>

<?php
function ListAllCrusts($pizza)
{
	foreach (Crust::GetAllValidCrustsIncludingPrices() as $crust => $price)
	{
		$checked = $pizza->HasThisCrust($crust) ? "checked" : "";
		CrustTemplate($crust, $price, $checked);
	}
}

function ListAllToppings($pizza)
{
	foreach (Topping::GetAllValidToppingsIncludingPrices() as $topping => $price)
	{
		$checked = $pizza->HasThisTopping($topping) ? "checked" : "";
		ToppingTemplate($topping, $price, $checked);
	}
}

// Templates
function CrustTemplate($crust, $price, $checked)
{
   print('<input name="Crust" value="' . $crust . '" type="radio" ' . $checked . '/>');
   print('<span>' . $crust . ' </span>');
   print('<span class="price">' . $price . '</span>');
}

function ToppingTemplate($topping, $price, $checked)
{
	print('<input name="Toppings[]" value="' . $topping . '" type="checkbox" ' . $checked . ' />');
	print('<span> ' . $topping . ' </span>');
	print('<span class="price">' . $price . '</span>');
}
