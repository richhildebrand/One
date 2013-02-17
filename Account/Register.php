<?php
    require_once("../Security/ForceHTTPS.php");
	require_once( "../Configs/Web.config" );
    require_once( "AccountController.php" );
?>

<html>
    <head>
        <link rel=StyleSheet href="../Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>Register for Paul's Pizza Palace</h1>
        <form method="post" action="">
            <label for="email">Enter your email address</label>
            <input type="email" required autofocus name="email" />
            <span class="error"> <?php print($errorResult) ?> </span>
            
            <label for="password">Create a password between 5 and 250 characters</label>
            <input type="password" pattern=".{5,250}" required 
                   name="password" id="password" onkeyup="confirmPasswordsMatch()"/>
            <span id="password-warning-one" class="error hide"> Your Passwords do not match </span>

            <label for="confirm-password">Confirm your password</label>
            <input type="password" pattern=".{5,250}" required 
                   name="confirm-password" id="confirm-password" onkeyup="confirmPasswordsMatch()"/>
            <span id="password-warning-two" class="error hide"> Your Passwords do not match </span>

            <button name="Register">Register</button>
        </form>

        <a href="Login.php">Login</a>
        <a href="Change-Password.php">Change Password</a>
        <a href="Forgot-Password.php">Forgot Password</a>

        <script type="text/javascript" src="../Scripts/confirmPasswordsMatch.js"></script>
    </body>
</html>