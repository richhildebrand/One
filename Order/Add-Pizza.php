<?php
	require_once("../Security/ForceHTTPS.php");
    require_once("../Configs/Web.config");
    require_once("../Security/SecureSession.php");
    require_once("OrderController.php");
    
    if (!isset($_SESSION['Order'])) { $_SESSION['Order'] = new Order(); }
    if (!isset($_SESSION['Pizza'])) { $_SESSION['Pizza'] = new Pizza(); }
    $order = $_SESSION['Order'];
    $pizza = $_SESSION['Pizza'];
    
?>
<!DOCTYPE html>
<html>
    <head>
    	<title> Paul's Pizza Palace </title>
        <link rel=StyleSheet href="../Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>Order from Paul's Pizza Palace</h1>
        <form method="post" action="">
        	<label for="Crust">Choose your crust</label>
	        	<input name="Crust" value="thin" type="radio"
	        		   <?php if ($pizza->HasThisCrust("thin")) { print("checked"); }; ?> />
	        	<span>Thin </span><span class="price">2 </span>

	        	<input name="Crust" value="thick" type="radio"
	        		   <?php if ($pizza->HasThisCrust("thick")) { print("checked"); }; ?> />
	        	<span>Thick </span><span class="price">5 </span>

	        <label for="Toppings[]">Choose your toppings</label>
	        	<input name="Toppings[]" value="onions" type="checkbox"
	        		   <?php if ($pizza->HasThisTopping("onions")) { print("checked"); }; ?> />
	        	<span>Onions </span><span class="price">2 </span>

	        	<input name="Toppings[]" value="peppers" type="checkbox"
	        		   <?php if ($pizza->HasThisTopping("peppers")) { print("checked"); }; ?> />
	        	<span>Peppers </span><span class="price">3 </span>

	        	<input name="Toppings[]" value="mushrooms" type="checkbox"
	        		   <?php if ($pizza->HasThisTopping("mushrooms")) { print("checked"); }; ?> />
	        	<span>Mushrooms </span><span class="price">4 </span>

	        	<button name="AddAnoterPizza">Add Another Pizza</button>
	        	<button name="Checkout">Save Pizza and Checkout</button>
        	</form>
    	</form>
	</body>
</html>
