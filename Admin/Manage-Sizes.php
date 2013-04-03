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
        <h1>Manage Sizes for Paul's Pizza Palace</h1>
        <form method="post">
            <ul>
                <li>
                    <input name="NewProductDescription" placeholder="New Size Description"/>
                    <input name="NewProductPrice" type="number" class="price" placeholder="New Size Price"/>
                    <button class="admin" name="AddNewProduct">Add New Size</button>
                </li>
                <li>
                    <hr>
                </li>
                <input type="hidden" name="ProductType" value="size">
        	   <?php $_templateBuilder->ListAllProducts('size'); ?>
            </ul>
    	</form>
    	<?php FooterHelper::DrawSessionFooter(); ?>
	</body>
</html>

<?php

// Templates
function ProductTemplate($size, $price, $id)
{
    print('<li>');
       print('<input name="UpdatedProductDescription' . $id . '" value="' . $size . ' "/>');
       print('<input class="price" name="UpdatedProductPrice' . $id . '" value="'. $price . '"/>');
       print('<button class="admin" name="UpdateProduct" value="' . $id . '">Update Size</button>');
       print('<button class="admin" name="RemoveProduct" value="' . $id . '">Remove Size</button>');
   print('</li>');
}
