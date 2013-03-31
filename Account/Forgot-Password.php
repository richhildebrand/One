<?php
    require_once("../Helpers/ForceHTTPS.php");
    require_once( "..//Web.config" );
    require_once( "../Controllers/AccountController.php" );
    include_once("../Helpers/FooterHelper.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <title> Paul's Pizza Palace </title>
        <link rel=StyleSheet href="../Frontend/Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>New Password for Paul's Pizza Palace</h1>
        <form method="post" >
            <label >Email</label>
            <input type="email" maxlength="250" required autofocus name="email" />
            <span class="error"> <?php print($errorResult) ?> </span>

            <button name="ForgotPassword">Send Password</button>
        </form>
        <?php FooterHelper::DrawAnonymousFooter(); ?>
    </body>
</html>