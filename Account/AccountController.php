<?php
require_once( "../Security/SecureHash.php" );
require_once( "../Database/DatabaseAccessor.php" );

$errorResult = "";

if(isset($_POST['Register']))
{
    $accountController = new AccountController;
    if ($accountController->RegisterUser( $_POST )) 
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
    $accountController = new AccountController;
    if ($accountController->MatchUserAndPassword( $_POST ))
    {
        header("Location: ../Order/Add-Pizza.php");
    }
    else
    {
        $errorResult = "Login information is not valid";
    }
} 

class AccountController
{
    public function RegisterUser( $data = array() )
    {
        $email = $data['email'];
        $password = $data['password'];
        if($this->IsValidUserSubmission($email, $password))
        {
            $databaseAccessor = new DatabaseAccessor;

            if(!$databaseAccessor->UserExists($email))
            {
                 $saltedPassword = create_hash($password);
                 return $databaseAccessor->RegisterUser($email, $saltedPassword);
            }
        }
        return false;
    }

    public function MatchUserAndPassword( $data = array() )
    {
        $email = $data['email'];
        $submittedPassword = $data['password'];
        if($this->IsValidUserSubmission($email, $submittedPassword))
        {
            $databaseAccessor = new DatabaseAccessor;
            $realUserPassword = $databaseAccessor->GetHashedPassword($email);
            return validate_password($submittedPassword, $realUserPassword);
        }
        return false;
    }

    public function IsValidUserSubmission( $email, $password ) {
        return strlen($email) > 0 && strlen($password) > 5;
    }
}