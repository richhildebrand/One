<?php
    require_once("../Helpers/ForceHTTPS.php");
    require_once( "../Web.config" );
    require_once("../Helpers/SecureSession.php");
    require_once("../Controllers/OrderController.php");
    require_once("../Helpers/AddPizzaListFunctions.php");

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
			<button name="Checkout">Checkout</button>
    	</form>
		<footer>
			<a href="../Account/Change-Password.php">Change Password</a>
			<a>Edit Profile</a>
			<a>View Orders History</a>
		</footer>
	</body>
</html>

<?php

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
