<?php
    require_once("../Helpers/ForceHTTPS.php");
	require_once( "../Web.config" );
    require_once("../Helpers/SecureSession.php");
    require_once( "../Controllers/AccountController.php" );
    require_once("../Helpers/FooterHelper.php");


    $userName = $_SESSION['userName'];
    $databaseAccessor = new DatabaseAccessor();
    $userProfile = $databaseAccessor->GetUserProfile($userName);
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
        <h2 class="success"> <?php print($successResult); ?> </h2>
        <form method="post" >
            <h2 name="email">
                <?php print($userProfile->GetEmail());?>
            </h2>

            <label >Enter your lastname</label>
            <input type="text" name="lastname"
            value = <?php print('"' . $userProfile->GetLastName() . '"'); ?>
             />
            
            <label >Enter your firstname</label>
            <input type="text" name="firstname"
            value = <?php print('"' . $userProfile->GetFirstName() . '"'); ?>
             />

            <label >Enter your street address</label>
            <input type="text" name="address"
            value = <?php print('"' . $userProfile->GetAddress() . '"');?>
             />

            <label >Enter your city</label>
            <input type="text" name="city"
            value = <?php print('"' . $userProfile->GetCity() . '"'); ?>
             />

            <label >Enter your state</label>
            <input type="text" name="state"
            value = <?php print('"' . $userProfile->GetState() . '"'); ?>
             />

            <label>Zip Code 5 Digits</label>
            <input type="number" pattern="[0-9]*" maxlength="5" min="0" name="zip5"
            value = <?php print('"' . $userProfile->GetZip5() . '"'); ?>
            />

            <label>Zip Code 4 Digits</label>
            <input type="number" pattern="[0-9]*" maxlength="4" min="0" name="zip4"
            value = <?php print('"' . $userProfile->GetZip4() . '"'); ?>
            />

            <button name="UpdateProfile">Update Profile</button>
        </form>
        <?php FooterHelper::DrawSessionFooter(); ?>
        <script type="text/javascript" src="../Frontend/Scripts/confirmPasswordsMatch.js"></script>
    </body>
</html>