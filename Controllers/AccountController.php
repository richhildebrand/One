<?php
require_once( "../Logic/AccountManager.php" );

$errorResult = "";
$successResult = "";

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
        $_SESSION['userName'] = $accountManager->_submittedEmail;
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
elseif(isset($_POST['UpdateProfile']))
{
   $databaseAccessor = new DatabaseAccessor();
   if ($databaseAccessor->SetUserProfile( $_POST, $_SESSION['userName']))
   {
        $successResult = "Your profile has been updated.";
   }
   else
   {
        $errorResult = "An error occured while updating your profile.";
   }
}
elseif(isset($_POST['Logout']))
{
  session_unset();
  session_destroy();
  header('Location: ../index.html');
}