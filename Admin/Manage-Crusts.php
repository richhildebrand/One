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
        	<?php $_templateBuilder->ListAllCrusts(); ?>
        	<input name="NewCrustDescription" placeholder="New Crust Description"/>
        	<input name="NewCrustPrice" class="price" placeholder="New Crust Price"/>
        	<button name="AddNewCrust">Add New Crust</button>
    	</form>
    	<?php FooterHelper::DrawSessionFooter(); ?>
	</body>
</html>

<?php

// Templates
function CrustTemplate($crust, $price, $id)
{
   print('<input name="UpdatedCrustDescription' . $id . '" value="' . $crust . ' "/>');
   print('<input class="price" name="UpdatedCrustPrice' . $id . '" value="'. $price . '"/>');
   print('<button name="UpdateCrust" value="' . $id . '">Update Crust</button>');
   print('<button name="RemoveCrust" value="' . $id . '">Remove Crust</button>');
}
