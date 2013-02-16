<?php
require_once( "AccountManager.php" );

$errorResult = "";

if(isset($_POST['Register']))
{
    $accountManager = new AccountManager( $_POST );
    if ($accountManager->RegisterUser()) 
    {
        header("Location: login.php");
    }
    else
    {
        $errorResult = "This Email is has already been registered";
    }
}

if(isset($_POST['Login'])) 
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

if(isset($_POST['ChangePassword'])) 
{
    $accountManager = new AccountManager( $_POST );
    if ($accountManager->ChangePassword())
    {
        header("Location: login.php");
    }
    else
    {
        $errorResult = "Current account information is not valid";
    }
} 