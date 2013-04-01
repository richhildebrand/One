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
        <h1>Manage Crusts for Paul's Pizza Palace</h1>
        <form method="post">
            <ul>
                <li>
                    <input name="NewCrustDescription" placeholder="New Crust Description"/>
                    <input name="NewCrustPrice" class="price" placeholder="New Crust Price"/>
                    <button class="admin" name="AddNewCrust">Add New Crust</button>
                </li>
                <li>
                    <hr>
                </li>
        	   <?php $_templateBuilder->ListAllCrusts(); ?>
            </ul>
    	</form>
    	<?php FooterHelper::DrawSessionFooter(); ?>
	</body>
</html>

<?php

// Templates
function CrustTemplate($crust, $price, $id)
{
    print('<li>');
       print('<input name="UpdatedCrustDescription' . $id . '" value="' . $crust . ' "/>');
       print('<input class="price" name="UpdatedCrustPrice' . $id . '" value="'. $price . '"/>');
       print('<button class="admin" name="UpdateCrust" value="' . $id . '">Update Crust</button>');
       print('<button class="admin" name="RemoveCrust" value="' . $id . '">Remove Crust</button>');
   print('</li>');
}
