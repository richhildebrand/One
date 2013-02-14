<?php
    require_once( "AccountController.php" );
    if(isset($_POST['Register']))
    {
        $accountController = new AccountController;
        $accountController->RegisterUser( $_POST );
        //header("Location: login.php");
    }   

?>
<html>
    <body>
        <h1>Register for Paul's Pizza Palace</h1>
        <form method="post" action="">
            <label for="email">Enter your email address</label>
            <input type="email" required autofocus name="email" />
            <label for="password">Create a password between 5 and 250 characters</label>
            <input type="password" pattern=".{5,250}" required name="password" />
            <label for="confirm-password">Confirm your password</label>
            <input type="password" pattern=".{5,250}" required name="confirm-password" />
            <button name="Register">Register</button>
        </form>
        <a href="Login.php">Login</a>
        <a href="Reset-Password.php">Reset Password</a>
    </body>
</html>