<?php
    require_once("../Configs/Web.config");
    require_once("../Security/SecureSession.php")
    require_once("OrderController.php");
    require_once("Pizza.php");
    require_once("Order.php")


    if (!isset($_SESSION['Order']) { $_SESSION['Order'] = new Order(); }
    $order = $_SESSION['Order'];
    $pizza = new Pizza();
    $order.AddPizza($pizza);
?>

<html>
    <head>
        <link rel=StyleSheet href="../Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>Order from Paul's Pizza Palace</h1>
        <form method="post" action="">
        	<label for="Crust">Choose your crust</label>
	        	<input name="Crust" value="thin" type="radio"
	        		   checked=<?php if ($pizza->HasThisCrust("thick")) { "checked"; }; ?> />
	        	<span> Thin </span>

	        	<input name="Crust" value="thick" type="radio"
	        		   <?php if ($pizza->HasThisCrust("thick")) { "checked"; }; ?> />
	        	<span> Thick </span>

	        <label for="Toppings">Choose your toppings</label>
	        	<input name="Toppings" value="onions" type="checkbox"
	        		   <?php if ($pizza->HasThisTopping("onions")) { "checked"; }; ?> />
	        	<span>Onions</span>

	        	<input name="Toppings" value="peppers" type="checkbox"
	        		   <?php if ($pizza->HasThisTopping("peppers")) { "checked"; }; ?> />
	        	<span>Peppers</span>

	        	<input name="Toppings" value="mushrooms" type="checkbox"
	        		   <?php if ($pizza->HasThisTopping("mushrooms")) { "checked"; }; ?> />
	        	<span>Mushrooms</span>

	        	<button name="SavePizza">Add Another Pizza</button>
	        	<button name="Checkout">Checkout</button>
        	</form>
    	</form>
	</body>
</html>
