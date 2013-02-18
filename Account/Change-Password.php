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
		<h1>Change your Password for Paul's Pizza Palace</h1>
		<form method="post" action="">
	        <label for="email">Enter your email address</label>
	        <input type="email" required autofocus name="email" />
	        <span class="error"> <?php print($errorResult) ?> </span>

	        <label for="password">Enter your current password</label>
	        <input type="password" pattern=".{5,250}" required name="password" />
	        
	        <label for="new-password">Set a new password between 5 and 250 characters</label>
	        <input type="password" pattern=".{5,250}" required 
	               name="new-password" id="password" onkeyup="confirmPasswordsMatch()"/>
	        <span id="password-warning-one" class="error hide"> Your New Passwords do not match </span>

	        <label for="confirm-new-password">Confirm your new password</label>
	        <input type="password" pattern=".{5,250}" required 
	               name="confirm-new-password" id="confirm-password" onkeyup="confirmPasswordsMatch()"/>
	        <span id="password-warning-two" class="error hide"> Your New Passwords do not match </span>

	        <button name="ChangePassword">Change Password</button>
	    </form>
        

        <a href="Login.php">Login</a>
		<a href="Register.php">Register Account</a>
		<a href="Forgot-Password.php">Forgot Password</a>

		<script type="text/javascript" src="../Scripts/confirmPasswordsMatch.js"></script>
	</body>
</html>