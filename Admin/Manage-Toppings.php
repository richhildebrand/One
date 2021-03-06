<?php
    require_once("../Helpers/ForceHTTPS.php");
    require_once("../Web.config" );
    require_once("../Helpers/SecureSession.php");
    require_once("../Controllers/AdminController.php");
    include_once("../Helpers/AdminTemplateBuilder.php");
    include_once("../Helpers/FooterHelper.php");

    $_templateBuilder = new AdminTemplateBuilder();
    
?>
<!DOCTYPE html>
<html>
    <head>
    	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    	<title> Paul's Pizza Palace </title>
        <link rel=StyleSheet href="../Frontend/Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>Manage Toppings for Paul's Pizza Palace</h1>
        <form method="post">
            <ul>
                <li>
                    <input name="NewToppingDescription" placeholder="New Topping Description"/>
                    <input name="NewToppingPrice" class="price" placeholder="New Topping Price"/>
                    <button class="admin" name="AddNewTopping">Add New Topping</button>
                </li>
                <li>
                    <hr>
                </li>
            	<?php $_templateBuilder->ListAllToppings(); ?>
            </ul>
    	</form>
        <?php FooterHelper::DrawSessionFooter(); ?>
	</body>
</html>

<?php

// Templates
function ToppingTemplate($topping, $price, $id)
{
   print('<li>');
       print('<input name="UpdatedToppingDescription' . $id . '" value="' . $topping . ' "/>');
       print('<input class="price" name="UpdatedToppingPrice' . $id . '" value="'. $price . '"/>');
       print('<button class="admin" name="UpdateTopping" value="' . $id . '">Update Topping</button>');
       print('<button class="admin" name="RemoveTopping" value="' . $id . '">Remove Topping</button>');
   print('</li>');
}
