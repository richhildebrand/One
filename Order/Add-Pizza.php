<?php
    require_once( "../Configs/Web.config" );
    //require_once( "AccountController.php" );
    require_once("Pizza.php");

    $pizza = new Pizza();
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

    	</form>
	</body>
</html>
