<?php
    require_once("../Helpers/ForceHTTPS.php");
    require_once( "..//Web.config" );
	require_once("../Helpers/SecureSession.php");
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
		<h1>Change your Password for Paul's Pizza Palace</h1>
		<form method="post" >
	        <label >Enter your email address</label>
	        <input type="email" required autofocus name="email" />
	        <span class="error"> <?php print($errorResult) ?> </span>

	        <label >Enter your current password</label>
	        <input type="password" pattern=".{5,250}" required name="password" />
	        
	        <label >Set a new password between 5 and 250 characters</label>
	        <input type="password" pattern=".{5,250}" required 
	               name="new-password" id="password" onkeyup="confirmPasswordsMatch()"/>
	        <span id="password-warning-one" class="error hide"> Your New Passwords do not match </span>

	        <label >Confirm your new password</label>
	        <input type="password" pattern=".{5,250}" required 
	               name="confirm-new-password" id="confirm-password" onkeyup="confirmPasswordsMatch()"/>
	        <span id="password-warning-two" class="error hide"> Your New Passwords do not match </span>

	        <button name="ChangePassword">Change Password</button>
	    </form>
	    <?php FooterHelper::DrawSessionFooter(); ?>
		<script type="text/javascript" src="../Frontend/Scripts/confirmPasswordsMatch.js"></script>
	</body>
</html>