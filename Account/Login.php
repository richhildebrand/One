<?php
    require_once("../Security/ForceHTTPS.php");
    require_once( "../Configs/Web.config" );
    require_once( "AccountController.php" );
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Paul's Pizza Palace </title>
        <link rel=StyleSheet href="../Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>Login to Paul's Pizza Palace</h1>
        <form method="post">
            <label >Email</label>
            <input type="email" maxlength="250" required autofocus name="email" />
            <span class="error"> <?php print($errorResult) ?> </span>

            <label >Password</label>
            <input type="password" maxlength="250" required name="password" />

            <button name="Login">Login</button>
        </form>

        <a href="Register.php">Register Account</a>
        <a href="Change-Password.php">Change Password</a>
        <a href="Forgot-Password.php">Forgot Password</a>
    </body>
</html>