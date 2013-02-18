<?php
require_once( "../BusinessLogic/AccountManager.php" );

$errorResult = "";

if(isset($_POST['Register']))
{
    $accountManager = new AccountManager( $_POST );
    if ($accountManager->RegisterUser()) 
    {
        header("Location: Login.php");
    }
    else
    {
        $errorResult = "This Email is has already been registered";
    }
}
elseif(isset($_POST['Login'])) 
{
    $accountManager = new AccountManager( $_POST );
    if ($accountManager->VerifyUserNameAndPassword())
    {
        session_start();
        $_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
        header("Location: ../Order/Add-Pizza.php");
    }
    else
    {
        $errorResult = "Login information is not valid";
    }
} 
elseif(isset($_POST['ChangePassword'])) 
{
    $accountManager = new AccountManager( $_POST );
    if ($accountManager->ChangePassword())
    {
        header("Location: Login.php");
    }
    else
    {
        $errorResult = "Current account information is not valid";
    }
}
elseif(isset($_POST['ForgotPassword']))
{
   $accountManager = new AccountManager( $_POST );
   if ($accountManager->ResetPassword())
   {
        header("Location: Login.php");
   }
   else
   {
        $errorResult = "Invalid Email Address";
   }
}