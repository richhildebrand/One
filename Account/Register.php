<?php
	require_once( "../Configs/Web.config" );
    require_once( "AccountController.php" );

    $userAlreadyExists = "";

    if(isset($_POST['Register']))
    {
        $accountController = new AccountController;
        if ($accountController->RegisterUser( $_POST )) 
        {
            header("Location: login.php");
        }
        else
        {
            $userAlreadyExists = "This Email is has already been registered";
        }
    }   
?>

<html>
    <head>

    </head>
    <body>
        <h1>Register for Paul's Pizza Palace</h1>
        <form method="post" action="">
            <label for="email">Enter your email address</label>
            <input type="email" required autofocus name="email" />
            <span> <?php print($userAlreadyExists) ?> </span>
            
            <label for="password">Create a password between 5 and 250 characters</label>
            <input type="password" pattern=".{5,250}" required 
                   name="password" id="password" onblur="confirmPasswordsMatch()"/>
            <span id="password-warning-one"> Your Passwords do not match </span>

            <label for="confirm-password">Confirm your password</label>
            <input type="password" pattern=".{5,250}" required 
                   name="confirm-password" id="confirm-password" onblur="confirmPasswordsMatch()"/>
            <span id="password-warning-two"> Your Passwords do not match </span>

            <button name="Register">Register</button>
        </form>
        <a href="Login.php">Login</a>
        <a href="Reset-Password.php">Reset Password</a>

        <script type="text/javascript">
            function confirmPasswordsMatch()
                {   
                    var password1=document.getElementById('password');
                    var password2=document.getElementById('confirm-password');
                    if ( password1.value != password2.value )
                    {  
                        document.getElementById('password-warning-one').style.display = "";
                        document.getElementById('password-warning-two').style.display = "";
                    }
                    else
                    {
                        document.getElementById('password-warning-one').style.display = "none";
                        document.getElementById('password-warning-two').style.display = "none";
                    }
                }
        </script>

    </body>
</html>