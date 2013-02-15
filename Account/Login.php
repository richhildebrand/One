<?php
    require_once( "../Configs/Web.config" );
    require_once( "AccountController.php" );
?>

<html>
    <head>
        <link rel=StyleSheet href="../Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>Login to Paul's Pizza Palace</h1>
        <form method="post" action="">
            <label for="email">Email</label>
            <input type="email" maxlength="250" required autofocus name="email" />
            <span class="error"> <?php print($errorResult) ?> </span>

            <label for="password">Password</label>
            <input type="password" maxlength="250" required name="password" />

            <button name="Login">Login</button>
        </form>
        <a href="Register.php">Register Account</a>
        <a href="Change-Password.php">Change Password</a>
    </body>
</html>