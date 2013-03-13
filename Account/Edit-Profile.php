<?php
    require_once("../Helpers/ForceHTTPS.php");
	require_once( "../Web.config" );
    require_once( "../Controllers/AccountController.php" );
?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <title> Paul's Pizza Palace </title>
        <link rel=StyleSheet href="../Frontend/Styles/site.css" type="text/css">
    </head>
    <body>
        <h1>Edit Profile for Paul's Pizza Palace</h1>
        <form method="post" >
            <h2 name="email">
                <?php GetUserEmail($pizza); ?>
            </h2>

            <label >Enter your lastname</label>
            <input type="text" name="lastname" />
            
            <label >Enter your firstname</label>
            <input type="text" name="firstname" />

            <label >Enter your street address</label>
            <input type="text" name="address" />

            <label >Enter your city</label>
            <input type="text" name="city" />

            <label >Enter your state</label>
            <input type="text" name="state" />

            <label>Zip Code 5 Digits</label>
            <input type="number" pattern="[0-9]*" maxlength="5" min="0" name="zip5">

            <label>Zip Code 4 Digits</label>
            <input type="number" pattern="[0-9]*" maxlength="4" min="0" name="zip4">

            <button name="UpdateProfile">Update Profile</button>
        </form>

        <footer>
            <a href="../Account/Change-Password.php">Change Password</a>
            <a href="../Account/Edit-Profile.php">Edit Profile</a>
            <a href="../Order/Order-History.php">View Orders History</a>
        </footer>

        <script type="text/javascript" src="../Frontend/Scripts/confirmPasswordsMatch.js"></script>
    </body>
</html>