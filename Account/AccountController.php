<?php
require_once( "../Security/SecureHash.php" );
require_once( "../Database/DatabaseAccessor.php" );

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

class AccountController
{
    public function RegisterUser( $data = array() )
    {
        $email = $data['email'];
        $password = $data['password'];

        $databaseAccessor = new DatabaseAccessor;
        if (strlen($email) > 0 && 
            strlen($password) > 5 &&
            !$databaseAccessor->UserExists($email))
        {
            $saltedPassword = create_hash($password);
            return $databaseAccessor->RegisterUser($email, $saltedPassword);
        }
        else
        {
            return false;
        }
    }
}